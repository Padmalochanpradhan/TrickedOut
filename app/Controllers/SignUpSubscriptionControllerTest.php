<?php

namespace App\Controllers;
use App\Libraries\StripeService2;
class SignUpSubscriptionControllerTest extends BaseController
{ 

    public function SignUpSubscription()
    {

        $stripeService = new StripeService2();
        // Get promotion code id from session
        if (!session()->has('employee_id')) {
            return redirect()->to('/login')->with('err_msg', 'Please login first');
        }
        $apidata = [
            "userId" => $_SESSION['employee_id']
        ];

        $promotion_code_id = '';
        $result = $this->curl->curl_call(APIURL."TrickedOutGetUserByID", $apidata);
        $user_details = json_decode($result);
        $user_data = $user_details->data ?? [];

        if (!empty($user_data)) {
            $promotion_code_id = $user_data[0]->promotion_code_id ?? '';
        } else {
            return redirect()->to('/login')->with('err_msg', 'Invalid login');
        }

        $couponDetails = null;

        if (!empty($promotion_code_id) && $promotion_code_id !== 'null') {
            $couponDetails = $stripeService->getPromotionCodeDetails($promotion_code_id);
        } 
        $apidata = array(
            "userId" => $_SESSION['employee_id']
        ); 
        $response = $stripeService->getStripeProductsWithPaymentLinks($promotion_code_id);
        $subscriptionList = $response['data'];
            //echo "<pre>";print_r($subscriptionList);exit;
        $data = [
            'title' => 'Subscription :: ' . PAGETITLE,
            'pageHeading' => 'Subscription',
            'subscriptions' => $subscriptionList
        ];          
        return view('login/SignUpSubscriptionView', $data);
    } 
}
