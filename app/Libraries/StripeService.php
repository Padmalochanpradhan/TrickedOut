<?php

namespace App\Libraries;

use Stripe\Stripe;
use Stripe\Price;
use Stripe\Product;
use Stripe\PaymentLink;
use Stripe\Subscription;
use Stripe\Invoice;
use Stripe\StripeClient;
class StripeService
{
    private $client;

    public function __construct()
    {
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
        $this->client = new StripeClient(getenv('STRIPE_SECRET_KEY'));
    }
    public function getAllStripePrices()
    {
        //\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        try {
            $prices = \Stripe\Price::all([
                'active' => true,
                'expand' => ['data.product'],
                'limit' => 100,
            ]);

            $priceList = [];

            foreach ($prices->data as $price) {

                // Only subscription prices
                if (!$price->recurring) {
                    continue;
                }

                $priceList[] = [$price];
                           
            }

            return [
                'status' => true,
                'data'   => $priceList,
            ];

        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => $e->getMessage(),
            ];
        }
    }
    public function getAllStripePaymentLink()
    {
        //\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        try {
            $links = \Stripe\PaymentLink::all([
                'active' => true,
                'limit'  => 1,
                'expand' => [
                'data.line_items.data.price'
                ]
            ]);

            $linkList = [];

            foreach ($links->data as $link) {

                

                $linkList[] = [$link];
                          
            }

            return [
                'status' => true,
                'data'   => $linkList,
            ];

        } catch (\Exception $e) {
            return [
                'status'  => false,
                'message' => $e->getMessage(),
            ];
        }
    }
    public function getStripeProductsWithPaymentLinks($promotion_code_id='')
    {
        //\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        //$promotion_code_id = 'promo_1T6Qn7JowK5c5OMakO7m1rVR';
        // 2️⃣ Get all payment links
        $paymentLinks = \Stripe\PaymentLink::all([
            'active' => true,
            'limit' => 100
        ]);
        $result = [];
        foreach ($paymentLinks->data as $link) {
            $linkdatails = $this->getPaymentLinkProductDetails($link->id, $promotion_code_id);
            $result[] = $linkdatails;
        }
        return [
            'status' => true,
            'data'   => $result
        ];

    }
     
public function getPaymentLinkProductDetails($paymentLinkId, $promotion_code_id = null)
{
    $paymentLink = \Stripe\PaymentLink::retrieve($paymentLinkId);

    $lineItems = \Stripe\PaymentLink::allLineItems($paymentLinkId, [
        'limit' => 10
    ]);

    $discountPercent = 0;
    $discountAmount = 0;
    $duration = null;
    $months = null;
    $promoCode = null;
    $allowedProducts = [];

    $promotion_code_id = trim((string)$promotion_code_id);
    // Get promo code
    if($promotion_code_id && strtolower($promotion_code_id) !== 'null' && strtolower($promotion_code_id) !== 'undefined') {

        $promo = \Stripe\PromotionCode::retrieve([
            'id' => $promotion_code_id,
            'expand' => ['promotion.coupon','promotion.coupon.applies_to']
        ]);
        //echo "<pre>";print_r($promo);exit;
        if ($promo && $promo->active) {

            $coupon = $promo->promotion->coupon;

            $promoCode = $promo->code;
            $discountPercent = $coupon->percent_off ?? 0;
            $discountAmount = $coupon->amount_off ?? 0;
            $duration = $coupon->duration ?? null;
            $months = $coupon->duration_in_months ?? null;

            // applicable products
            $allowedProducts = $coupon->applies_to->products ?? [];
        }
    }

    foreach ($lineItems->data as $item) {

        $price = $item->price;
        $interval = $item->price->recurring->interval;
        $product = \Stripe\Product::retrieve($price->product);
        //echo "<pre>";print_r($item);exit;
        $originalAmount = $price->unit_amount / 100;
        $finalAmount = $originalAmount;

        $isPromoValidForProduct = true;

        // Check if coupon has product restriction
        if (!empty($allowedProducts)) {

            if (!in_array($product->id, $allowedProducts)) {
                $isPromoValidForProduct = false;
            }
        }

        // Apply discount only if product valid
        if ($isPromoValidForProduct) {

            if ($discountPercent > 0) {
                $finalAmount = $originalAmount - ($originalAmount * $discountPercent / 100);
            }

            if ($discountAmount > 0) {
                $finalAmount = $originalAmount - ($discountAmount / 100);
            }
        }

        if ($finalAmount < 0) {
            $finalAmount = 0;
        }

        $previewMessage = null;
        $promoCodeValid = 0;

        if ($isPromoValidForProduct && ($discountPercent || $discountAmount)) {

            if ($duration == "repeating") {

                $previewMessage = "Promo code applied. You will pay $" . $finalAmount .
                    " per month for $months months. After that $" .
                    $originalAmount . " per ".$interval.".";

            } elseif ($duration == "once") {

                $previewMessage = "Promo code applied. First billing $" .
                    $finalAmount . ". Next billing $" . $originalAmount;

            } elseif ($duration == "forever") {

                $previewMessage = "Promo code applied. New price $" .
                    $finalAmount . " per ".$interval.".";
            }
            $promoCodeValid = 1;

        } elseif (!$isPromoValidForProduct && $promoCode) {
            $promoCodeValid = 0;
            $previewMessage = "Promo code is not valid for this plan.";
        }

        $volume = $product->metadata['volume'] ?? null;
        $bg_image = $product->metadata['bg_image'] ?? null;
        $button_color = $product->metadata['button_color'] ?? null;
        $display_desc = $product->metadata['display_desc'] ?? null;

        $result = [
            'payment_link_id' => $paymentLink->id,
            'payment_url'     => $paymentLink->url,

            'product_id'      => $product->id,
            'product_name'    => $product->name,
            'product_description' => $display_desc,

            'volume'          => $volume,
            'bg_image'        => $bg_image,
            'button_color'    => $button_color,

            'price_id'        => $price->id,

            'original_price'  => $originalAmount,
            'amount'     => round($finalAmount,2),

            'discount_percent'=> $discountPercent,
            'promo_code'      => $promoCode,
            'promoCodeValid'  => $promoCodeValid,

            'currency'        => strtoupper($price->currency),
            'interval'        => $price->recurring->interval ?? null,
            'trial_days'      => $paymentLink->subscription_data->trial_period_days ?? 0,

            'preview_message' => $previewMessage
        ];
    }

    return $result;
}   

public function previewUpgradeInvoice(
    string $subscriptionId,
    string $subscriptionItemId,
    string $targetPriceId,
    ?string $promoCode = null
) {
    $params = [
        'subscription' => $subscriptionId,
        'subscription_details' => [
            'items' => [
                [
                    'id'    => $subscriptionItemId,
                    'price' => $targetPriceId,
                ],
            ],
            'proration_behavior' => 'create_prorations',
        ],
    ];

    $promoMessage = null;
    $promoSuccess = null;
    // Try applying promo code (non-blocking)
    if (!empty($promoCode)) {
        $promo = $this->client->promotionCodes->all([
            'code'   => $promoCode,
            'active' => true,
            'limit'  => 1,
        ]);
        //echo "<pre>";print_r($promo);exit;
        if (!empty($promo->data)) {
            // Valid promo
            $params['discounts'] = [
                [
                    'promotion_code' => $promo->data[0]->id,
                ],
            ];
            $promoMessage = 'Promo code applied successfully.';
            $promoSuccess = true;
        } else {
            // Invalid promo → continue without discount
            $promoMessage = 'Invalid or expired promo code.';
            $promoSuccess = false;
        }
    }

    // Always return preview
    $invoice = $this->client->invoices->createPreview($params);

    return [
        'invoice'      => $invoice,
        'promoMessage' => $promoMessage,
        'promoSuccess' => $promoSuccess,
    ];
}

    public function getSubscription($subscriptionId)
    {
        if (!$subscriptionId) {
            return null;
        }

        return Subscription::retrieve($subscriptionId);
    } 
public function getActiveAndTrialSubscriptions(int $limit = 100)
{
    try {
        $allSubscriptions = [];

        // Fetch ACTIVE subscriptions
        $active = $this->getSubscriptionsByStatus('active', $limit);

        // Fetch TRIALING subscriptions
        $trialing = $this->getSubscriptionsByStatus('trialing', $limit);

        if ($active['status']) {
            $allSubscriptions = array_merge($allSubscriptions, $active['data']);
        }

        if ($trialing['status']) {
            $allSubscriptions = array_merge($allSubscriptions, $trialing['data']);
        }

        return [
            'status' => true,
            'data'   => $allSubscriptions,
        ];

    } catch (\Exception $e) {
        return [
            'status'  => false,
            'message' => $e->getMessage(),
        ];
    }
}
private function getSubscriptionsByStatus(string $status, int $limit = 100)
{
    $subscriptions = [];
    $startingAfter = null;
    $productCache  = [];

    do {
        $params = [
            'status' => $status,
            'limit'  => $limit,
            'expand' => [
                'data.customer',
                'data.items.data.price',
            ],
        ];

        if ($startingAfter) {
            $params['starting_after'] = $startingAfter;
        }

        $response = \Stripe\Subscription::all($params);

        foreach ($response->data as $subscription) {

            $item  = $subscription->items->data[0] ?? null;
            $price = ($item && isset($item->price)) ? $item->price : null;

            // Product
            $productId = null;
            $productName = null;

            if ($price && isset($price->product)) {
                $productId = $price->product;

                if (isset($productCache[$productId])) {
                    $productName = $productCache[$productId];
                } else {
                    $product = \Stripe\Product::retrieve($productId);
                    $productName = $product->name ?? null;
                    $productCache[$productId] = $productName;
                }
            }

            $subscriptions[] = [
                'subscription_id' => $subscription->id,
                'status'          => $subscription->status,

                'customer_id'     => is_object($subscription->customer)
                    ? $subscription->customer->id
                    : $subscription->customer,

                'customer_email'  => is_object($subscription->customer)
                    ? $subscription->customer->email
                    : null,

                // Product
                'product_id'      => $productId,
                'product_name'    => $productName,

                // Price
                'price_id'        => $price ? $price->id : null,
                'amount'          => $price ? $price->unit_amount / 100 : 0,
                'currency'        => $price ? strtoupper($price->currency) : null,
                'interval'        => ($price && isset($price->recurring))
                    ? $price->recurring->interval
                    : null,

                // Dates (SAFE)
                'trial_end'       => isset($subscription->trial_end) && $subscription->trial_end
                    ? date('Y-m-d', $subscription->trial_end)
                    : null,

                'period_start'    => isset($subscription->current_period_start)
                    ? date('Y-m-d', $subscription->current_period_start)
                    : null,

                'period_end'      => isset($subscription->current_period_end)
                    ? date('Y-m-d', $subscription->current_period_end)
                    : null,
            ];
        }

        $startingAfter = $response->has_more
            ? end($response->data)->id
            : null;

    } while ($startingAfter);

    return [
        'status' => true,
        'data'   => $subscriptions,
    ];
}
public function getPromotionCodeDetails($promotion_code_id)
{
    \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

    try {

        $promo = \Stripe\PromotionCode::retrieve([
            'id' => $promotion_code_id,
            'expand' => ['coupon']
        ]);

        return [$promo];


    } catch (\Exception $e) {

        return null;

    }
}


 

///////////////////// Code Start ///////////////////////////////

    function getPromoProductDetails($promo_code){
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        try {

            // 1️⃣ Get Promotion Code
            $promotionCodes = \Stripe\PromotionCode::all([
                'code' => $promo_code,
                'limit' => 1
            ]); 

            if (empty($promotionCodes->data)) {
                return ["error" => "Invalid promo code"];
            }

            $promotion = $promotionCodes->data[0]; 

            // 2️⃣ Get Coupon
            $coupon = \Stripe\Coupon::retrieve($promotion->promotion->coupon); 
            $products = [];

            if (!empty($coupon->metadata->Product_Id)) {

                $product_id = $coupon->metadata->Product_Id;

                // Get product
                $product = \Stripe\Product::retrieve($product_id);

                // Get price for that product
                $prices = \Stripe\Price::all([
                    'product' => $product_id,
                    'limit' => 1
                ]);

                if (!empty($prices->data)) {
                    $price = $prices->data[0];

                    $products[] = [
                        "product_id" => $product->id,
                        "product_name" => $product->name,
                        "price_id" => $price->id,
                        "price" => $price->unit_amount / 100,
                        "currency" => $price->currency,
                        "interval" => $price->recurring->interval ?? "one_time"
                    ];
                }

                return $products;
            }         

        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function paymentByPriceId($price_id, $promotion_code_id = null, $email = null)
    {
        try { 
            
            $params = [
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $price_id,
                    'quantity' => 1,
                ]],
                'mode' => 'subscription', // change to 'payment' if one-time
                'subscription_data' => [],
                'success_url' => 'https://trickedoutmagic.com/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'https://trickedoutmagic.com/cancel',
            ];
            // Pre-fill email in Stripe Checkout
            if (!empty($email)) {
                $params['customer_email'] = $email;
            }
            // Apply promotion code if available
            if (!empty($promotion_code_id)) {
                 
                $params['discounts'] = [[
                   'promotion_code' => $promotion_code_id
                ]];
            }

            $session = \Stripe\Checkout\Session::create($params); 

            return [
                'status' => true,
                'checkout_url' => $session->url,
                'session_id' => $session->id
            ];

        } catch (\Exception $e) {

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
public function getUpcomingBilling($subscriptionId)
{
    try {

        $invoice = $this->client->invoices->createPreview([
            'subscription' => $subscriptionId,
        ]);

        return [
            'status' => true,
            'data' => [
                'next_billing_date' => isset($invoice->period_end)
                    ? date('m/d/Y', $invoice->period_end)
                    : null,

                'amount_due' => isset($invoice->amount_due)
                    ? $invoice->amount_due / 100
                    : 0,

                'currency' => isset($invoice->currency)
                    ? strtoupper($invoice->currency)
                    : null,
            ],
            'invoice' => $invoice
        ];

    } catch (\Stripe\Exception\InvalidRequestException $e) {

        return [
            'status' => false,
            'message' => 'No upcoming billing found'
        ];

    } catch (\Exception $e) {

        return [
            'status' => false,
            'message' => $e->getMessage()
        ];
    }
}
public function getNextPayableBill($subscriptionId)
{
    try {
        $invoice = $this->client->invoices->createPreview([
            'subscription' => $subscriptionId,
        ]);

        $currentTimestamp = $invoice->lines->data[0]->period->end ?? null;

        if (!is_numeric($currentTimestamp) || $currentTimestamp <= 0) {
            return [
                'status' => false,
                'message' => 'Invalid billing period from invoice'
            ];
        }

        $currentTimestamp = (int) $currentTimestamp;

        $maxIterations = 12;

        for ($i = 0; $i < $maxIterations; $i++) {

            $futureInvoice = $this->client->invoices->createPreview([
                'subscription' => $subscriptionId,
                'subscription_details' => [
                    'proration_date' => $currentTimestamp
                ]
            ]);

            $amountDue = $futureInvoice->amount_due / 100;

            // ✅ Found payable
            if ($amountDue > 0) {
                return [
                    'status' => true,
                    'data' => [
                        'next_billing_date' => date("m/d/Y", $currentTimestamp),
                        'amount_due' => $amountDue,
                        'currency' => strtoupper($futureInvoice->currency),
                    ]
                ];
            }

            // ❗ Move using Stripe period (correct way)
            $nextPeriod = $futureInvoice->lines->data[0]->period->end ?? null;

            if (!is_numeric($nextPeriod) || $nextPeriod <= 0) {
                break;
            }

            $currentTimestamp = (int) $nextPeriod;
        }

        // ❗ If still no payable found
        return [
            'status' => true,
            'data' => [
                'next_billing_date' => null,
                'amount_due' => 0,
                'currency' => strtoupper($invoice->currency),
                'message' => 'No payable billing (discount still active or forever)'
            ]
        ];

    } catch (\Exception $e) {
        return [
            'status' => false,
            'message' => $e->getMessage()
        ];
    }
}
    ///////////////////// Code End ///////////////////////////////

}
