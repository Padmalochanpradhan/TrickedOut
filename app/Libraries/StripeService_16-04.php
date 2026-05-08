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
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
        $this->client = new StripeClient($_ENV['STRIPE_SECRET_KEY']);
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
                // $priceList[] = [
                //     'price_id'      => $price->id,
                //     'product_id'    => $price->product->id ?? null,
                //     'product_name'  => $price->product->name ?? '',
                //     'amount'        => $price->unit_amount / 100,
                //     'currency'      => strtoupper($price->currency),
                //     'interval'      => $price->recurring->interval,        // month / year
                //     'interval_count'=> $price->recurring->interval_count,
                //     'trial_days'    => $price->recurring->trial_period_days ?? 0,
                //     'nickname'      => $price->nickname,
                //     'metadata'      => $price->metadata,
                // ];            
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

                // Only subscription prices
                // if (!$price->recurring) {
                //     continue;
                // }

                $linkList[] = [$link];
                // $priceList[] = [
                //     'price_id'      => $price->id,
                //     'product_id'    => $price->product->id ?? null,
                //     'product_name'  => $price->product->name ?? '',
                //     'amount'        => $price->unit_amount / 100,
                //     'currency'      => strtoupper($price->currency),
                //     'interval'      => $price->recurring->interval,        // month / year
                //     'interval_count'=> $price->recurring->interval_count,
                //     'trial_days'    => $price->recurring->trial_period_days ?? 0,
                //     'nickname'      => $price->nickname,
                //     'metadata'      => $price->metadata,
                // ];            
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
    // public function getPaymentLinkProductDetails($paymentLinkId, $promotion_code_id = null)
    // {
    //     //\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

    //     // 1️⃣ Retrieve payment link
    //     $paymentLink = \Stripe\PaymentLink::retrieve($paymentLinkId);

    //     // 2️⃣ Retrieve line items (THIS IS THE KEY)
    //     $lineItems = \Stripe\PaymentLink::allLineItems($paymentLinkId, [
    //         'limit' => 10
    //     ]);

    //     //$result = [];

    //     foreach ($lineItems->data as $item) {

    //         $price = $item->price;

    //         // 3️⃣ Get product using price.product
    //         $product = \Stripe\Product::retrieve($price->product);
    //         $volume = $product->metadata['volume'] ?? null;
    //         $bg_image = $product->metadata['bg_image'] ?? null;
    //         $button_color = $product->metadata['button_color'] ?? null;
    //         $result = [
    //             'payment_link_id' => $paymentLink->id,
    //             'payment_url'     => $paymentLink->url,

    //             'product_id'      => $product->id,
    //             'product_name'    => $product->name,
    //             'product_description' => $product->description,
    //             'volume'          => $volume,
    //             'bg_image'         => $bg_image,
    //             'button_color'      => $button_color,

    //             'price_id'        => $price->id,
    //             'amount'          => $price->unit_amount / 100,
    //             'currency'        => strtoupper($price->currency),
    //             'interval'        => $price->recurring->interval ?? null,
    //             'trial_days'      => $paymentLink->subscription_data->trial_period_days ?? 0,
    //         ];
    //     }

    //     return $result;
    // }
// public function getPaymentLinkProductDetails($paymentLinkId, $promotion_code_id = null)
// {
//     $paymentLink = \Stripe\PaymentLink::retrieve($paymentLinkId);

//     $lineItems = \Stripe\PaymentLink::allLineItems($paymentLinkId, [
//         'limit' => 10
//     ]);

//     $discountPercent = 0;
//     $discountAmount = 0;
//     $duration = null;
//     $months = null;
//     $promoCode = null;
//     $allowedProducts = [];
// //return $promotion_code_id;
//     // Get promo code
//     if (!empty($promotion_code_id)) {

//         $promo = \Stripe\PromotionCode::retrieve([
//             'id' => $promotion_code_id,
//             'expand' => ['promotion.coupon','promotion.coupon.applies_to']
//         ]);
// //return $promo;
//         if ($promo && $promo->active) {

//             $coupon = $promo->coupon->id;

//             $promoCode = $promo->code;
//             $discountPercent = $coupon->percent_off ?? 0;
//             $discountAmount = $coupon->amount_off ?? 0;
//             $duration = $coupon->duration ?? null;
//             $months = $coupon->duration_in_months ?? null;

//             // applicable products
//             $allowedProducts = $coupon->applies_to->products ?? [];
//         }
//     }

//     foreach ($lineItems->data as $item) {

//         $price = $item->price;

//         $product = \Stripe\Product::retrieve($price->product);

//         $originalAmount = $price->unit_amount / 100;
//         $finalAmount = $originalAmount;

//         $isPromoValidForProduct = true;

//         // Check if coupon has product restriction
//         if (!empty($allowedProducts)) {

//             if (!in_array($product->id, $allowedProducts)) {
//                 $isPromoValidForProduct = false;
//             }
//         }

//         // Apply discount only if product valid
//         if ($isPromoValidForProduct) {

//             if ($discountPercent > 0) {
//                 $finalAmount = $originalAmount - ($originalAmount * $discountPercent / 100);
//             }

//             if ($discountAmount > 0) {
//                 $finalAmount = $originalAmount - ($discountAmount / 100);
//             }
//         }

//         if ($finalAmount < 0) {
//             $finalAmount = 0;
//         }

//         $previewMessage = null;
//         $promoCodeValid = 0;

//         if ($isPromoValidForProduct && ($discountPercent || $discountAmount)) {

//             if ($duration == "repeating") {

//                 $previewMessage = "Promo code applied. You will pay $" . $finalAmount .
//                     " per month for $months months. After that $" .
//                     $originalAmount . " per month.";

//             } elseif ($duration == "once") {

//                 $previewMessage = "Promo code applied. First billing $" .
//                     $finalAmount . ". Next billing $" . $originalAmount;

//             } elseif ($duration == "forever") {

//                 $previewMessage = "Promo code applied. New price $" .
//                     $finalAmount . " per month.";
//             }
//             $promoCodeValid = 1;

//         } elseif (!$isPromoValidForProduct && $promoCode) {
//             $promoCodeValid = 0;
//             $previewMessage = "Promo code is not valid for this plan.";
//         }

//         $volume = $product->metadata['volume'] ?? null;
//         $bg_image = $product->metadata['bg_image'] ?? null;
//         $button_color = $product->metadata['button_color'] ?? null;

//         $result = [
//             'payment_link_id' => $paymentLink->id,
//             'payment_url'     => $paymentLink->url,

//             'product_id'      => $product->id,
//             'product_name'    => $product->name,
//             'product_description' => $product->description,

//             'volume'          => $volume,
//             'bg_image'        => $bg_image,
//             'button_color'    => $button_color,

//             'price_id'        => $price->id,

//             'original_price'  => $originalAmount,
//             'amount'     => round($finalAmount,2),

//             'discount_percent'=> $discountPercent,
//             'promo_code'      => $promoCode,
//             'promoCodeValid'  => $promoCodeValid,

//             'currency'        => strtoupper($price->currency),
//             'interval'        => $price->recurring->interval ?? null,
//             'trial_days'      => $paymentLink->subscription_data->trial_period_days ?? 0,

//             'preview_message' => $previewMessage
//         ];
//     }

//     return $result;
// }
// public function getPaymentLinkProductDetails($paymentLinkId, $promotion_code_id = null)
// {
//     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

//     $paymentLink = \Stripe\PaymentLink::retrieve($paymentLinkId);

//     $lineItems = \Stripe\PaymentLink::allLineItems($paymentLinkId, [
//         'limit' => 10,
//         'expand' => ['data.price.product']
//     ]);

//     $discountPercent = 0;
//     $discountAmount = 0;
//     $duration = null;
//     $months = null;
//     $promoCode = null;
//     $allowedProducts = [];

//     $promotion_code_id = trim((string)$promotion_code_id);
//     // Get promo code
//     if($promotion_code_id && strtolower($promotion_code_id) !== 'null' && strtolower($promotion_code_id) !== 'undefined') {
//         $promo = \Stripe\PromotionCode::retrieve([
//             'id' => $promotion_code_id,
//             'expand' => ['coupon']
//         ]);

//         if ($promo && $promo->active) {

//             $coupon = $promo->coupon;

//             $promoCode = $promo->code;
//             $discountPercent = $coupon->percent_off ?? 0;
//             $discountAmount = $coupon->amount_off ?? 0;
//             $duration = $coupon->duration ?? null;
//             $months = $coupon->duration_in_months ?? null;

//             $allowedProducts = $coupon->applies_to->products ?? [];
//         }
//     }

//     foreach ($lineItems->data as $item) {

//         $price = $item->price;
//         $product = $price->product;

//         $originalAmount = $price->unit_amount / 100;
//         $finalAmount = $originalAmount;

//         $isPromoValidForProduct = true;

//         // Check product restriction
//         if (!empty($allowedProducts)) {

//             if (!in_array($product->id, $allowedProducts)) {
//                 $isPromoValidForProduct = false;
//             }
//         }

//         // Apply discount
//         if ($isPromoValidForProduct) {

//             if ($discountPercent > 0) {
//                 $finalAmount = $originalAmount - ($originalAmount * $discountPercent / 100);
//             }

//             if ($discountAmount > 0) {
//                 $finalAmount = $originalAmount - ($discountAmount / 100);
//             }
//         }

//         if ($finalAmount < 0) {
//             $finalAmount = 0;
//         }

//         $previewMessage = null;
//         $promoCodeValid = 0;

//         if ($isPromoValidForProduct && ($discountPercent || $discountAmount)) {

//             if ($duration == "repeating") {

//                 $previewMessage = "Promo code applied. You will pay $" . $finalAmount .
//                     " per month for $months months. After that $" .
//                     $originalAmount . " per month.";

//             } elseif ($duration == "once") {

//                 $previewMessage = "Promo code applied. First billing $" .
//                     $finalAmount . ". Next billing $" . $originalAmount;

//             } elseif ($duration == "forever") {

//                 $previewMessage = "Promo code applied. New price $" .
//                     $finalAmount . " per month.";
//             }

//             $promoCodeValid = 1;

//         } elseif (!$isPromoValidForProduct && $promoCode) {

//             $promoCodeValid = 0;
//             $previewMessage = "Promo code is not valid for this plan.";
//         }

//         $volume = $product->metadata['volume'] ?? null;
//         $bg_image = $product->metadata['bg_image'] ?? null;
//         $button_color = $product->metadata['button_color'] ?? null;

//         $result = [
//             'payment_link_id' => $paymentLink->id,
//             'payment_url' => $paymentLink->url,

//             'product_id' => $product->id,
//             'product_name' => $product->name,
//             'product_description' => $product->description,

//             'volume' => $volume,
//             'bg_image' => $bg_image,
//             'button_color' => $button_color,

//             'price_id' => $price->id,

//             'original_price' => $originalAmount,
//             'amount' => round($finalAmount, 2),

//             'discount_percent' => $discountPercent,
//             'promo_code' => $promoCode,
//             'promoCodeValid' => $promoCodeValid,

//             'currency' => strtoupper($price->currency),
//             'interval' => $price->recurring->interval ?? null,
//             'trial_days' => $paymentLink->subscription_data->trial_period_days ?? 0,

//             'preview_message' => $previewMessage
//         ];
//     }

//     return $result;
// }   
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
// public function getPaymentLinkProductDetails($paymentLinkId, $promotion_code_id = null)
// {
//     $paymentLink = \Stripe\PaymentLink::retrieve($paymentLinkId);

//     $lineItems = \Stripe\PaymentLink::allLineItems($paymentLinkId, [
//         'limit' => 10
//     ]);

//     $discountPercent = 0;
//     $discountAmount = 0;

//     // Get promotion code details
//     if ($promotion_code_id) {

//         $promo = \Stripe\PromotionCode::retrieve([
//             'id' => $promotion_code_id,
//             'expand' => ['promotion.coupon']
//         ]);
//         echo "<pre>";print_r($promo);exit;
//         $coupon = $promo->coupon;

//         if ($coupon->percent_off) {
//             $discountPercent = $coupon->percent_off;
//         }

//         if ($coupon->amount_off) {
//             $discountAmount = $coupon->amount_off / 100;
//         }
//     }

//     foreach ($lineItems->data as $item) {

//         $price = $item->price;
//         $product = \Stripe\Product::retrieve($price->product);

//         $originalAmount = $price->unit_amount / 100;
//         $finalAmount = $originalAmount;

//         // Apply percent discount
//         if ($discountPercent > 0) {
//             $finalAmount = $originalAmount - ($originalAmount * $discountPercent / 100);
//         }

//         // Apply fixed discount
//         if ($discountAmount > 0) {
//             $finalAmount = $originalAmount - $discountAmount;
//         }

//         $volume = $product->metadata['volume'] ?? null;
//         $bg_image = $product->metadata['bg_image'] ?? null;
//         $button_color = $product->metadata['button_color'] ?? null;

//         $result = [
//             'payment_link_id' => $paymentLink->id,
//             'payment_url'     => $paymentLink->url,

//             'product_id'      => $product->id,
//             'product_name'    => $product->name,
//             'product_description' => $product->description,

//             'volume'          => $volume,
//             'bg_image'        => $bg_image,
//             'button_color'    => $button_color,

//             'price_id'        => $price->id,

//             'original_amount' => $originalAmount,
//             'final_amount'    => round($finalAmount, 2),

//             'discount_percent'=> $discountPercent,
//             'discount_amount' => $discountAmount,

//             'currency'        => strtoupper($price->currency),
//             'interval'        => $price->recurring->interval ?? null,
//             'trial_days'      => $paymentLink->subscription_data->trial_period_days ?? 0,
//         ];
//     }

//     return $result;
// }    
    /**
     * Preview upgrade invoice (proration)
     */
    // public function previewUpgradeInvoice(
    //     string $subscriptionId,
    //     string $subscriptionItemId,
    //     string $newPriceId
    // ) {
    //     $invoices = Invoice::all([
    //         'subscription' => $subscriptionId,
    //         'limit'        => 5,
    //         // 'upcoming'     => true,
    //         // 'subscription_items' => [
    //         //     [
    //         //         'id'    => $subscriptionItemId,
    //         //         'price' => $newPriceId,
    //         //     ],
    //         //],
    //     ]);

    //     return $invoices->data[0] ?? null;
    // }
// public function previewUpgradeInvoice(
//     string $subscriptionId,
//     string $subscriptionItemId,
//     string $targetPriceId
// ) {
//     // Correct method is 'upcoming()'
//     return $this->client->invoices->createPreview([
//         'subscription' => $subscriptionId,
//         'subscription_details' => [
//             'items' => [
//                 [
//                     'id'    => $subscriptionItemId,
//                     'price' => $targetPriceId,
//                 ],
//             ],
//             'proration_behavior' => 'create_prorations',
//         ],
//     ]);
// }
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

        // return [
        //     'id' => $promo->id,
        //     'code' => $promo->code,
        //     'name' => $promo->coupon->name,
        //     'percent_off' => $promo->coupon->percent_off,
        //     'amount_off' => $promo->coupon->amount_off,
        //     'currency' => $promo->coupon->currency,
        //     'duration' => $promo->coupon->duration
        // ];
    } catch (\Exception $e) {

        return null;

    }
}


    // public function getAllActiveSubscriptions(int $limit = 100)
    // {
    //     try {
    //         $subscriptions = [];
    //         $startingAfter = null;

    //         do {
    //             $params = [
    //                 'status' => 'trialing',
    //                 'limit'  => $limit,
    //                 'expand' => [
    //                     'data.customer',
    //                     'data.items.data.price',
    //                 ],
    //             ];

    //             if ($startingAfter) {
    //                 $params['starting_after'] = $startingAfter;
    //             }

    //             $response = \Stripe\Subscription::all($params);
    //             //echo "<pre>";print_r($response);exit;
    //             foreach ($response->data as $subscription) {

    //                 $item  = $subscription->items->data[0] ?? null;

    //                 $price = null;
    //                 if ($item && isset($item->price)) {
    //                     $price = $item->price;
    //                 }

    //                 // Fetch product only if needed
    //                 $product = null;
    //                 if ($price && is_string($price->product)) {
    //                     $product = \Stripe\Product::retrieve($price->product);
    //                 }

    //                 $subscriptions[] = [
    //                     'subscription_id' => $subscription->id,
    //                     'status'          => $subscription->status,

    //                     'customer_id'     => is_object($subscription->customer)
    //                         ? $subscription->customer->id
    //                         : $subscription->customer,

    //                     'customer_email'  => is_object($subscription->customer)
    //                         ? $subscription->customer->email
    //                         : null,

    //                     'product_id'      => $product ? $product->id : null,
    //                     'product_name'    => $product ? $product->name : null,

    //                     'price_id'        => $price ? $price->id : null,
    //                     'amount'          => $price ? $price->unit_amount / 100 : 0,
    //                     'currency'        => $price ? strtoupper($price->currency) : null,
    //                     'interval'        => ($price && isset($price->recurring))
    //                         ? $price->recurring->interval
    //                         : null,

    //                     'period_start'    => date('Y-m-d', $subscription->current_period_start),
    //                     'period_end'      => date('Y-m-d', $subscription->current_period_end),
    //                 ];
    //             }

    //             $startingAfter = $response->has_more
    //                 ? end($response->data)->id
    //                 : null;

    //         } while ($startingAfter);

    //         return [
    //             'status' => true,
    //             'data'   => $subscriptions,
    //         ];

    //     } catch (\Exception $e) {
    //         return [
    //             'status'  => false,
    //             'message' => $e->getMessage(),
    //         ];
    //     }
    // }

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

    public function paymentByPriceId($price_id, $promotion_code_id = null)
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
                'success_url' => 'https://trickedoutmagic.com/stripe/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'https://trickedoutmagic.com/stripe/cancel',
            ];

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
    ///////////////////// Code End ///////////////////////////////

}
