<?php

namespace App\Controllers;

//use CodeIgniter\Controller;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Libraries\Mailer;

class StripeController extends BaseController
{
    public function createCheckoutSession()
    {
        
            $paymentUrl = $this->request->getPost('payment_url');
            $priceId    = $this->request->getPost('price_id');
            $promo_code = $this->request->getPost('promo_code');
            $userId = $_SESSION['employee_id'];
            $email  = $_SESSION['email_id'];

            if (!$paymentUrl || !$priceId) {
                return redirect()->back()->with('err_msg', 'Invalid plan selection');
            }

            
            $params = [
                'client_reference_id' => $userId,
                'prefilled_email'     => $email
            ];

            // Add promo code only if it exists
            if (!empty($promo_code)) {
                $params['prefilled_promo_code'] = $promo_code;
            }

            $redirectUrl = $paymentUrl . '?' . http_build_query($params);

            return redirect()->to($redirectUrl);
    }

    public function success()
    {
        //echo "<pre>";print_r

        /*\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        // If you stored session_id earlier
        $session_id = $this->request->getGet('session_id'); // You must pass it in success_url

        $subceription_id = $this->request->getGet('subceription_id'); 
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        $subscriptionId = $session->subscription;
        $customerId = $session->customer;

        // Optionally retrieve full subscription
        $subscription = \Stripe\Subscription::retrieve($subscriptionId);

            //echo "<pre>";print_r($subscription);exit;

        // Inactive all subscription
            $data_file = array(
                "status" => 1
            );
            $update_data = array(
                "id_field_name" => "user_id",
                "id_field_value" => $_SESSION['employee_id'],
                "table_name" => "user_subscription",
                "updateData" => $data_file
            );
            $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);

        // Insert data in user subscription table
        //$subscription_id = 1;
        $insertDataArray = array();

        $insertData = array(                 
            "user_id" => $_SESSION['employee_id'],
            'stripe_subscription_id' => $subscription->id,
            'stripe_customer_id' => $subscription->customer,
            'stripe_price_id' => $subscription->items->data[0]->price->id,

            "subscription_id" => $subceription_id,
            "price" => $subscription->items->data[0]->price->unit_amount,        
            "payment_status" => 1,        
            //'amount' => $subscription->items->data[0]->price->unit_amount,
            'currency' => $subscription->currency,
            'stripe_status' => $subscription->status,
            'plan_interval' => $subscription->items->data[0]->price->recurring->interval,
            'start_date' => date('Y-m-d H:i:s', $subscription->start_date),
            'current_period_start' => date('Y-m-d H:i:s', $subscription->items->data[0]->current_period_start),
            'current_period_end' => date('Y-m-d H:i:s', $subscription->items->data[0]->current_period_end),
            "added_by" => $_SESSION['employee_id']      
        );
        array_push($insertDataArray,$insertData);
                
        $insert = array(
            "insertDataArray" => $insertDataArray,
            "table_name" => 'user_subscription'
        );
        $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert);
        //echo 
        $response = json_decode($result, true);

        // Access the insertId
        $insertId = $response['data']['insertId'];

        //// Insert subscription transaction
        $insertTransactionDataArray = array();
        $data = [
        'subscription_id' => $insertId,
        'amount' => $subscription->items->data[0]->price->unit_amount,
        'current_period_start' => date('Y-m-d H:i:s', $subscription->items->data[0]->current_period_start),
        'current_period_end' => date('Y-m-d H:i:s', $subscription->items->data[0]->current_period_end),
        'payment_status' => 1
            ];
        array_push($insertTransactionDataArray,$data);
        $insert = array(
            "insertDataArray" => $insertTransactionDataArray,
            "table_name" => 'subscription_transactions'
        );
        $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert);
        ////////////////////////////////////////////////////
         $apidata = array(
        "userId" => $_SESSION['employee_id']
    ); 
   
    //$this->session->setFlashdata('err_msg', 'Invalid username or password');
     $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserCurrentSubscriptionDetails',$apidata);
     $currentSubscriptionDetails = json_decode($result);
     //echo "<pre>";print_r($currentSubscriptionDetails);exit;
     $currentSubscriptionDetails = $currentSubscriptionDetails->data[0];
$body = '<table width="90%" border="0" cellspacing="5" cellpadding="5" style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
    <tr>
        <td>
            <img src="'.base_url().'/assets/images/tricked_logo1.png" style="width:60%;" alt="Tricked Out Logo">
        </td>
    </tr>
    <tr>
        <td>Hello,</td>
    </tr>
    <tr>
        <td>Thank you for subscribing to <strong>Tricked Out</strong>!</td>
    </tr>
    <tr>
        <td>
            Your subscription has been successfully activated. Now, enhanced storage is based on your selected plan.
        </td>
    </tr>
    <tr>
        <td><strong>Plan Name:</strong> '.$currentSubscriptionDetails->subscription_name.'</td>
    </tr>
    <tr>
        <td><strong>Monthly Price:</strong> $'.number_format($currentSubscriptionDetails->price,2).'</td>
    </tr>
    <tr>
        <td><strong>Storage Limit:</strong> '.$currentSubscriptionDetails->volume_inGB.'GB</td>
    </tr>
    <tr>
        <td>You can view or manage your subscription anytime by logging into your account:</td>
    </tr>
    <tr>
        <td><a href="'.base_url('login').'" style="color: #1a73e8;">Log In to Your Account</a></td>
    </tr>
    <tr>
        <td>If you have any questions or need assistance, feel free to contact our support team. We’re here to help!</td>
    </tr>
    <tr>
        <td>Thanks for choosing Tricked Out!<br>The Tricked Out Team</td>
    </tr>
</table>
';
                        $mailer = new Mailer();
                        //$to = 'bamadebupadhya@gmail.com';
                        $to = $_SESSION['email_id'];
                        $subject = 'Tricked Out - Subscription';  
                        $mail = $mailer->sendMail($to, $subject, $body);*/
        $this->session->setFlashdata("err_msg", "Subscription is activating.");
        return redirect()->to(base_url('login')); exit;
       //echo "<pre>";print_r($result);exit;
            //return view('stripe_success');
    }

    public function cancel()
    {
        return view('stripe_cancel');
    }
public function upgradeSubscriptionCheckout()
{

//echo "<pre>";print_r($_POST);exit;
    //$stripeSubscriptionId = $_POST['stripeSubscriptionId'];
    $newPriceId = $_POST['product_price_id'];
     $promoCode = $_POST['promo_code'];
    //$subceription_id = $_POST['subceription_id'];
    //$user_subscription_id = $_POST['user_subscription_id'];
    $userId = $_SESSION['employee_id'];
    /////Get subscription details befor upgrade
    $apidata = array(
        "userId" => $_SESSION['employee_id']
    ); 

     $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserCurrentSubscriptionDetails',$apidata);
     $oldSubscriptionDetails = json_decode($result);
     $oldSubscriptionDetails = $oldSubscriptionDetails->data[0];
     $stripeSubscriptionId = $oldSubscriptionDetails->stripe_subscription_id;
    //echo "<pre>";print_r($oldSubscriptionDetails);exit;
    \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

    // 1. Retrieve current subscription
    $subscription = \Stripe\Subscription::retrieve($stripeSubscriptionId);
    $price = $subscription->items->data[0]->price;
    // 3️⃣ Retrieve Product using price
    $product = \Stripe\Product::retrieve($price->product);
    $productMetadataOld = $product->metadata;

    $subscriptionOld = $subscription;
    $priceOld = $price;
    $productOld = $product;
    
    $productNameOld = $productOld->name;
    $unit_amountOld = $priceOld->unit_amount;
    $priceIntervalOld = $priceOld->recurring->interval;
    $volumeGBOld = $productMetadataOld->volume;
    $couponId = null;

    if ($promoCode !== '') {
        try {
            $promotionCodes = \Stripe\PromotionCode::all([
                'code' => $promoCode,
                'active' => true,
                'limit' => 1
            ]);

            if (!empty($promotionCodes->data)) {
                $couponId = $promotionCodes->data[0]->coupon->id;
            }
        } catch (\Exception $e) {
            // silently ignore invalid promo
        }
    }
    $params = [
        'items' => [[
            'id' => $subscription->items->data[0]->id,
            'price' => $newPriceId,
        ]],
        'proration_behavior' => 'create_prorations',
    ];
    // apply promo
    if ($couponId) {
        $params['discounts'] = [
            ['coupon' => $couponId]
        ];
    }
    // 2. Perform upgrade
    $updated = \Stripe\Subscription::update($stripeSubscriptionId, $params);
    //echo "<pre>";print_r($updated);exit;
    //$updated = \Stripe\Subscription::retrieve($stripeSubscriptionId);
       $subscription = \Stripe\Subscription::retrieve($stripeSubscriptionId);
    $price = $subscription->items->data[0]->price;
    // 3️⃣ Retrieve Product using price
    $product = \Stripe\Product::retrieve($price->product);
    $productMetadata = $product->metadata;

    $productName = $product->name;
    $unit_amount = $price->unit_amount;
    $priceInterval = $priceOld->recurring->interval;
    $volumeGB = $productMetadataOld->volume;
    
    // 3. Fetch latest invoice to get amount charged after proration
    $invoice = \Stripe\Invoice::retrieve($updated->latest_invoice);

    // 4. Update the existing subscription record
    $updateData = [
        "updateData" => [
            //'subscription_id' => $subceription_id,
            'stripe_price_id' => $updated->items->data[0]->price->id,
            'plan_interval' => $updated->items->data[0]->price->recurring->interval,
            'current_period_start' => date('Y-m-d H:i:s', $updated->items->data[0]->current_period_start),
            'current_period_end' => date('Y-m-d H:i:s', $updated->items->data[0]->current_period_end),
            'stripe_status' => $updated->status,
            'volume_inGB' => $productMetadata->volume,
            'price' => $updated->items->data[0]->price->unit_amount,
        ],
        "id_field_name" => "stripe_subscription_id",
        "id_field_value" => $stripeSubscriptionId,
        "table_name" => "user_subscription"
    ];
    $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields', $updateData);
    $response = json_decode($result, true);
    $this->session->setFlashdata("err_msg", "Subscription upgraded successfully.");

    $oldStorageFormatted = $this->formatStorage($volumeGBOld);
    $newStorageFormatted = $this->formatStorage($volumeGB);
    ///////Upgrade email data

    $body = '<table width="90%" border="0" cellspacing="5" cellpadding="5" style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
        <tr>
            <td>
                <img src="'.base_url().'/assets/images/tricked_logo1.png" style="width:150px;" alt="Tricked Out Logo">
            </td>
        </tr>
        <tr>
            <td>Hello,</td>
        </tr>
        <tr>
            <td>Thank you for upgrading your subscription plan!</td>
        </tr>
        <tr>
            <td>
                You’ve successfully upgraded from the 
                <strong>'.$productNameOld.' Plan ($'.number_format($unit_amountOld/100, 2).'/'.$priceIntervalOld.', '.$oldStorageFormatted.' storage)</strong>
                to the 
                <strong>'.$productName.' Plan ($'.number_format($unit_amount/100, 2).'/'.$priceInterval.', '.$newStorageFormatted.' storage)</strong>.
            </td>
        </tr>
        <tr>
            <td>Your new plan gives you expanded storage and access to advanced features to better manage your trick files and boost productivity.</td>
        </tr>
        <tr>
            <td>If you have any questions or need help, our support team is here for you.</td>
        </tr>
        <tr>
            <td>Thanks for choosing Tricked Out!<br>The Tricked Out Team</td>
        </tr>
    </table>';
    //echo $body;exit;
                        $mailer = new Mailer();
                        //$to = 'bamadebupadhya@gmail.com';
                        $to = $_SESSION['email_id'];
                        $subject = 'Tricked Out - Subscription upgrade';  
                        $mail = $mailer->sendMail($to, $subject, $body);

    

    return redirect()->to(base_url('Subscription/'));
}
function formatStorage($gb)
{
    if ($gb >= 1024) {
        return round($gb / 1024, 2) . ' TB';
    }
    return round($gb, 2) . ' GB';
}
public function getAllStripePrices()
{
    \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

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

            $priceList[] = [
                'price_id'      => $price->id,
                'product_id'    => $price->product->id ?? null,
                'product_name'  => $price->product->name ?? '',
                'amount'        => $price->unit_amount / 100,
                'currency'      => strtoupper($price->currency),
                'interval'      => $price->recurring->interval,        // month / year
                'interval_count'=> $price->recurring->interval_count,
                'trial_days'    => $price->recurring->trial_period_days ?? 0,
                'nickname'      => $price->nickname,
                'metadata'      => $price->metadata,
            ];
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
   public function cancelSubscription()
    {
        //echo "<pre>";print_r($_POST);exit;
        $stripeSubscriptionId = $this->request->getPost('stripe_subscription_id'); // or get() based on your UI
         $user_subscription_id = $this->request->getPost('user_subscription_id'); // or get() based on your UI
       $cancelImmediately = true; // optional flag

        if (!$stripeSubscriptionId) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Stripe subscription ID is required.',
            ]);
        }

        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        try {
            if ($cancelImmediately) {
                // Cancel now
                $canceledSubscription = \Stripe\Subscription::retrieve($stripeSubscriptionId);
                $canceledSubscription->cancel();
            } else {
                // Cancel at period end
                \Stripe\Subscription::update($stripeSubscriptionId, [
                    'cancel_at_period_end' => true,
                ]);
            }

            //  Optional: Update your DB/API
            $data = [
                "updateData" => [
                    "stripe_status" => $cancelImmediately ? "canceled" : "pending_cancel",
                    "status" => 1,
                ],
                "id_field_name" => "stripe_subscription_id",
                "id_field_value" => $stripeSubscriptionId,
                "table_name" => "user_subscription",
            ];
            $this->curl->curl_call(APIURL . 'TrickedOutUpdateTableMultipleFields', $data);
    $this->session->setFlashdata("err_msg", "Subscription cancelled successfully.");

            /*return $this->response->setJSON([
                'status' => true,
                'message' => $cancelImmediately ? 'Subscription cancelled immediately.' : 'Subscription will cancel at period end.',
            ]);*/

$body = '<table width="90%" border="0" cellspacing="5" cellpadding="5" style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
    <tr>
        <td>
            <img src="'.base_url().'/assets/images/tricked_logo1.png" style="width:60%;" alt="Tricked Out Logo">
        </td>
    </tr>
    
    <tr>
        <td>Hello,</td>
    </tr>
    
    <tr>
        <td>We’re sorry to see you go! Your subscription has been successfully cancelled.</td>
    </tr>
    
    <tr>
        <td>
            Your current plan will remain active until the end of your billing period. After that, you will be able to access your tricks for 90 days from today. After 90 days, your tricks will be permanently removed from your account.
        </td>
    </tr>
    
    <tr>
        <td>
            If you change your mind, you can reactivate your subscription at any time by logging in to your account and choosing a new plan.
        </td>
    </tr>
    
    <tr>
        <td><a href="'.base_url().'" style="color: #1a73e8;">Manage Your Account</a></td>
    </tr>
    
    <tr>
        <td>
            We appreciate the opportunity to have served you. If you have any feedback or questions, feel free to contact us — we’d love to hear from you!
        </td>
    </tr>
    
    <tr>
        <td>Thanks again,<br>The Tricked Out Team</td>
    </tr>
</table>

';
                        $mailer = new Mailer();
                        //$to = 'bamadebupadhya@gmail.com';
                        $to = $_SESSION['email_id'];
                        $subject = 'Tricked Out - Subscription cancelled';  
                        $mail = $mailer->sendMail($to, $subject, $body);


        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    return redirect()->to(base_url('Subscription/'));

    }
public function validate_coupon()
{
    \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

    $promoCode = trim($this->request->getPost('coupon_code'));

    if (empty($promoCode)) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Promo code is required'
        ]);
    }

    try {

        $promotionCodes = \Stripe\PromotionCode::all([
            'code' => $promoCode,
            'active' => true,
            'limit' => 1
        ]);

        if (empty($promotionCodes->data)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid promo code'
            ]);
        }

        $promo = $promotionCodes->data[0];

        //return $promotionCodes;
        // return $this->response->setJSON([
        //         'status' => false,
        //         'message' => 'Promo code expired',
        //         'promo' => $promo
        //     ]);
        //$couponId = $promo->coupon->id;
        $couponId = $promo->promotion->coupon;
        $coupon = \Stripe\Coupon::retrieve($couponId);

        // Check expiry
        if ($promo->expires_at && $promo->expires_at < time()) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Promo code expired'
            ]);
        }

        // Check max redemptions
        if (
            $coupon->max_redemptions &&
            $coupon->times_redeemed >= $coupon->max_redemptions
        ) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Promo code fully used'
            ]);
        }

        // Discount info
        if ($coupon->percent_off) {
            $discountType = 'percent';
            $discountValue = $coupon->percent_off;
        } else {
            $discountType = 'amount';
            $discountValue = $coupon->amount_off / 100;
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Promo code applied',
            'data' => [
                'promotion_code_id' => $promo->id,
                'coupon_id' => $coupon->id,
                'discount_type' => $discountType,
                'discount_value' => $discountValue,
                //'currency' => strtoupper($coupon->currency),
                'name' => $coupon->name,
                'coupon' => $coupon,
                'applicable_products' => $coupon->applies_to->products ?? []
            ]
        ]);

    } catch (\Exception $e) {

        return $this->response->setJSON([
            'status' => false,
            'message' => $e->getMessage()
        ]);

    }
}
// public function apply_coupon_plan(){
//         $stripeService = new \App\Libraries\StripeService();

//     $promotion_code_id = session()->post('promotion_code_id') ?? '';

//     $response = $stripeService->getStripeProductsWithPaymentLinks($promotion_code_id);

//     $data['subscriptions'] = $response['data'] ?? [];

//     return view('partials/plan_cards', $data); // ONLY plans HTML
// }

    /*public getUpcommingInvoice($customer_id,$subscription_id){
        $invoice = \Stripe\Invoice::upcoming([
            'customer' => $customer_id,
            'subscription' => $subscription_id,
        ]);
    }
    public getSubscriptionLastInvoice(){
        $subscription = \Stripe\Subscription::retrieve($subscriptionId);
        $invoice = \Stripe\Invoice::retrieve($subscription->latest_invoice);
    }*/
}
