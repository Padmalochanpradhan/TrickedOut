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
    public function getStripeProductsWithPaymentLinks()
    {
        //\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));


        // 2️⃣ Get all payment links
        $paymentLinks = \Stripe\PaymentLink::all([
            'active' => true,
            'limit' => 100
        ]);
        foreach ($paymentLinks->data as $link) {
            $linkdatails = $this->getPaymentLinkProductDetails($link->id);
            $result[] = $linkdatails;
        }
        return [
            'status' => true,
            'data'   => $result
        ];

    }
    public function getPaymentLinkProductDetails($paymentLinkId)
    {
        //\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        // 1️⃣ Retrieve payment link
        $paymentLink = \Stripe\PaymentLink::retrieve($paymentLinkId);

        // 2️⃣ Retrieve line items (THIS IS THE KEY)
        $lineItems = \Stripe\PaymentLink::allLineItems($paymentLinkId, [
            'limit' => 10
        ]);

        //$result = [];

        foreach ($lineItems->data as $item) {

            $price = $item->price;

            // 3️⃣ Get product using price.product
            $product = \Stripe\Product::retrieve($price->product);
            $volume = $product->metadata['volume'] ?? null;
            $bg_image = $product->metadata['bg_image'] ?? null;
            $button_color = $product->metadata['button_color'] ?? null;
            $result = [
                'payment_link_id' => $paymentLink->id,
                'payment_url'     => $paymentLink->url,

                'product_id'      => $product->id,
                'product_name'    => $product->name,
                'product_description' => $product->description,
                'volume'          => $volume,
                'bg_image'         => $bg_image,
                'button_color'      => $button_color,

                'price_id'        => $price->id,
                'amount'          => $price->unit_amount / 100,
                'currency'        => strtoupper($price->currency),
                'interval'        => $price->recurring->interval ?? null,
                'trial_days'      => $paymentLink->subscription_data->trial_period_days ?? 0,
            ];
        }

        return $result;
    }
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

}
