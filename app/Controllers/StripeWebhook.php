<?php

namespace App\Controllers;

use Stripe\Webhook;
use Stripe\Stripe;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhook extends BaseController
{
    public function handle()
    {
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
        $secret     = getenv('STRIPE_WEBHOOK_SECRET');
        log_message('error', 'Stripe webhook hit');        
        $payload    = @file_get_contents('php://input');
        $sigHeader  = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';


        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $secret
            );
        } catch (\UnexpectedValueException $e) {
            return $this->response->setStatusCode(400);
        } catch (SignatureVerificationException $e) {
            return $this->response->setStatusCode(400);
        }
log_message('error', 'Stripe event: ' . $event->type);
//log_message('error', json_encode($event->data->object));
        // ✅ Valid Stripe event
        $this->processEvent($event);

        return $this->response->setStatusCode(200);
    }
    private function processEvent($event)
    {
        log_message('error', $event->type);
        switch ($event->type) {

            case 'checkout.session.completed':
                $this->handleCheckoutCompleted($event->data->object);
                break;

            case 'invoice.payment_succeeded':
                //$this->handleInvoicePaid($event->data->object);
                //$this->handleCheckoutCompleted($event->data->object);
                $this->handleInvoicePaymentSucceeded($event->data->object);
                break;

            case 'invoice.payment_failed':
                //$this->handleInvoiceFailed($event->data->object);
                break;
        }
    }
private function handleCheckoutCompleted($session)
{
    // ✅ Use client_reference_id (NOT metadata)
    //log_message('error', json_encode($session));
    $userId = $session->client_reference_id ?? null;
//log_message('error', 'Missing userId or subscription in checkout.session.completed');
    if (!$userId || !$session->subscription) {
        log_message('error', 'Missing userId or subscription in checkout.session.completed');
        return;
    }

    \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

    // ✅ Retrieve subscription
    $subscription = \Stripe\Subscription::retrieve($session->subscription);
    $price = $subscription->items->data[0]->price;
    // 3️⃣ Retrieve Product using price
    $product = \Stripe\Product::retrieve($price->product);
    $productMetadata = $product->metadata;
//log_message('error', json_encode($productMetadata));
//log_message('error', json_encode($price));
    // Prevent duplicate inserts
    if ($this->subscriptionExists($subscription->id)) {
            $data_file = array(
                "current_period_start" => date('Y-m-d H:i:s', $subscription->current_period_start),
                "current_period_end"   => date('Y-m-d H:i:s', $subscription->current_period_end),
                "stripe_status"        => $subscription->status
            );
            $update_data = array(
                "id_field_name" => "stripe_subscription_id",
                "id_field_value" => $subscription->id,
                "table_name" => "user_subscription",
                "updateData" => $data_file
            );
            $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);         
            return;
    }
    $insertDataArray = array();
    $insertData = [
        'user_id' => $userId,

        'stripe_subscription_id' => $subscription->id,
        'stripe_customer_id'     => $subscription->customer,
        'stripe_price_id'        => $price->id,

        'price' => $price->unit_amount / 100,
        'currency' => strtoupper($subscription->currency),

        'stripe_status'  => $subscription->status,   // trialing / active
        'payment_status' => 1,
        'plan_interval'  => $price->recurring->interval,

        'trial_start' => $subscription->trial_start
            ? date('Y-m-d H:i:s', $subscription->trial_start)
            : null,
        'trial_end' => $subscription->trial_end
            ? date('Y-m-d H:i:s', $subscription->trial_end)
            : null,
        'start_date' => date('Y-m-d H:i:s', $subscription->start_date),
        'current_period_start' => date('Y-m-d H:i:s', $subscription->current_period_start),
        'current_period_end'   => date('Y-m-d H:i:s', $subscription->current_period_end),
        'volume_inGB' => $productMetadata->volume,
        'added_by' => $userId
    ];

    array_push($insertDataArray,$insertData);
            
    $insert = array(
        "insertDataArray" => $insertDataArray,
        "table_name" => 'user_subscription'
    );
    //log_message('error',  json_encode($insert));
    $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert);
    //log_message('error',  json_encode($result));
}
private function handleInvoicePaymentSucceeded($invoice)
{
    log_message('error', 'invoice.payment_succeeded received');

    if (empty($invoice->subscription)) {
        log_message('error', 'No subscription found in invoice');
        return;
    }

    try {

        $subscriptionId = $invoice->subscription;

        // ✅ Get correct period from invoice
        $periodStart = $invoice->lines->data[0]->period->start;
        $periodEnd   = $invoice->lines->data[0]->period->end;

        log_message('error', 'New Period Start: ' . date('Y-m-d H:i:s', $periodStart));
        log_message('error', 'New Period End: ' . date('Y-m-d H:i:s', $periodEnd));

        $data_file = array(
            "current_period_start" => date('Y-m-d H:i:s', $periodStart),
            "current_period_end"   => date('Y-m-d H:i:s', $periodEnd),
            "stripe_status"        => "active"
        );

        $update_data = array(
            "id_field_name"  => "stripe_subscription_id",
            "id_field_value" => $subscriptionId,
            "table_name"     => "user_subscription",
            "updateData"     => $data_file
        );

        $result = $this->curl->curl_call(
            APIURL.'TrickedOutUpdateTableMultipleFields',
            $update_data
        );

        log_message('error', 'Subscription period updated correctly');

    } catch (\Exception $e) {

        log_message('error', 'Invoice handler error: ' . $e->getMessage());

    }
}


    private function subscriptionExists($stripeSubscriptionId)
    {
        $param = array(
            "stripe_subscription_id" => $stripeSubscriptionId
        );
        $result=$this->curl->curl_call(APIURL.'TrickedOutgetStripeSubscriptionDetails',$param);
        log_message('error', 'Subscription exist.', $result);
            if (!empty($result) && isset($result['data']) && count($result['data']) > 0) {
                return true;
            }

            return false;
    }
}
