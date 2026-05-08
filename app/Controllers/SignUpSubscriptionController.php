<?php

namespace App\Controllers;
use App\Libraries\StripeService;
class SignUpSubscriptionController extends BaseController
{ 

    public function SignUpSubscription()
    {

        $stripeService = new StripeService();
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
        

        ////////////// START /////////////////////
        if (!empty($couponDetails) && isset($couponDetails[0]->code) && !empty($couponDetails[0]->code)) {
            $productResponse = $stripeService->getPromoProductDetails($couponDetails[0]->code);
           if (!empty($productResponse) && isset($productResponse[0]['price_id']) && !empty($productResponse[0]['price_id'])) {
                $email_id = $_SESSION['email_id'];
                $result = $stripeService->paymentByPriceId($productResponse[0]['price_id'],$promotion_code_id,$email_id);
                //echo "<pre>";print_r($result);exit; 
                if ($result['status']) {
                    return redirect()->to($result['checkout_url']);
                }
           }
            
        }
        ///////////// END ///////////////////////////////  


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
