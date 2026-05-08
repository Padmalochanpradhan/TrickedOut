<?php

namespace App\Controllers;
use App\Libraries\StripeService;
class SubscriptionController extends BaseController
{ 

    public function Subscription()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        $stripeService = new StripeService();

        //$billing = $stripeService->getNextPayableBill('sub_1TLivMJowK5c5OMa7oTHwVA4'); 
        //echo "<pre>";print_r($billing);exit;       
        $response = $stripeService->getStripeProductsWithPaymentLinks();
        $subscriptionList = $response['data'];
        //echo "<pre>";print_r($subscriptionList);exit;
            if($_POST){                  
               $from =  $_POST['from'];
               $to =  $_POST['to'];
            }else{
               $from =  date('6/01/Y');
               $to =  date('m/d/Y',strtotime("+1 month"));

            } 
           
            $apidata = array(
                "userId" => $_SESSION['employee_id']
            ); 

             $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserCurrentSubscriptionDetails',$apidata);
             $currentSubscriptionDetails = json_decode($result);
             

            $result1=$this->curl->curl_call(APIURL.'TrickedOutgetStripeSubscriptionDetails',$apidata);
            $subscription = json_decode($result1);
            //echo "<pre>";print_r($subscription);exit; 

            //  $stripeSubscriptionId = null;
            //     if (!empty($currentSubscriptionDetails->data) && isset($currentSubscriptionDetails->data[0]->stripe_subscription_id)) {
            //         $stripeSubscriptionId = $currentSubscriptionDetails->data[0]->stripe_subscription_id;
            //     }
            //     $currentPriceId = null;
            //     $currentInterval = null;
            //     $currentProductId = null;

            // if ($stripeSubscriptionId) {
            //     $subscription = $stripeService->getSubscription($stripeSubscriptionId);
            //     //echo "<pre>";print_r($subscription);
            //     if ($subscription && in_array($subscription->status, ['active', 'trialing'])) {
            //         $item = $subscription->items->data[0];
            //         $currentPriceId   = $item->price->id;
            //         $currentInterval  = $item->price->recurring->interval; // month | year
            //         $currentProductId = $item->price->product;
            //     }
            // }

$stripeSubId = $currentSubscriptionDetails->data[0]->stripe_subscription_id ?? null;

$stripeSubscription = null;
$currentPriceId     = null;
$currentInterval    = null;
$currentProductId   = null;

if ($stripeSubId) {
    $stripeSubscription = $stripeService->getSubscription($stripeSubId);

    if ($stripeSubscription && in_array($stripeSubscription->status, ['active', 'trialing'])) {
        $item = $stripeSubscription->items->data[0];

        $currentPriceId   = $item->price->id;
        $currentInterval  = $item->price->recurring->interval;
        $currentProductId = $item->price->product;
    }
}            
             //echo "stripeSubscriptionId :".$currentPriceId;exit;
         
        //echo "<pre>";print_r($trickCategoryList->data);exit;
        $actionList = array();

        $totalGB = isset($subscription->data[0]->volume_inGB) ? $subscription->data[0]->volume_inGB : 0;
        // Convert GB to MB
        $totalMB = $totalGB * 1024; 
        if ($totalGB >= 1024) {                    
            $total = round($totalGB / 1024, 2);
            $unit  = 'TB';
        } else {                   
            $total = round($totalGB, 2);
            $unit  = 'GB';
        }

        $data = [
            'title'   => 'SUBSCRIPTION :: '.PAGETITLE,
            'fromdate' => $from,
            'todate' => $to,
            'subscriptionList' => $subscriptionList,
            'currentSubscriptionDetails' => isset($currentSubscriptionDetails->data) ? $currentSubscriptionDetails->data : [],
            'pageHeading' => 'MY VAULT',
            'currentPriceId' => $currentPriceId,
            'storage' => $total.$unit,
            'subscription' => isset($subscription->data[0]) ? $subscription->data[0] : [],
            'currentInterval' => $currentInterval,
            'currentProductId' => $currentProductId,
            'stripeSubscriptionId' => $stripeSubId
        ]; 
        //echo "<pre>";print_r($data);exit;
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('subscription/SubscriptionView',$data)
              .view('templates/footer_blank',$data);
    }
    public function subscriptionUpgrade(){
        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        //echo "<pre>";print_r($_POST);exit;
            $targetPriceId = $this->request->getPost('product_price_id');
            $promo_code = $this->request->getPost('promo_code');

            if (!$targetPriceId) {
                return redirect()->back()->with('error', 'Invalid upgrade request');
            }

            // 🔐 Get subscription from DB (NOT from client)
            $apidata = array(
                "userId" => $_SESSION['employee_id']
            ); 

             $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserCurrentSubscriptionDetails',$apidata);
             $currentSubscriptionDetails = json_decode($result);
             //echo "<pre>";print_r($currentSubscriptionDetails);exit;
            // $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
            // $trickCategoryList = json_decode($result);
             $stripeSubId = $currentSubscriptionDetails->data[0]->stripe_subscription_id;

            if (!$stripeSubId) {
                return redirect()->back()->with('error', 'No active subscription found');
            }
            $stripeService = new StripeService();
            $response = $stripeService->getStripeProductsWithPaymentLinks();
            $subscriptionList = $response['data'];
            //$stripeSubId = $subRow['stripe_subscription_id'];

            $stripeService = new StripeService();

            $subscription = $stripeService->getSubscription($stripeSubId);

            $invoiceReturn = $stripeService->previewUpgradeInvoice(
                $subscription->id,
                $subscription->items->data[0]->id,
                $targetPriceId, $promo_code
            ); 
            //echo "<pre>";print_r($invoiceReturn);exit;
            $invoice = $invoiceReturn['invoice'];
            $promoMessage = $invoiceReturn['promoMessage'];
            $promoSuccess = $invoiceReturn['promoSuccess'];
            $data = [
                    'title'   => 'SUBSCRIPTION UPGRADE:: '.PAGETITLE,
                    'subscriptionList' => $subscriptionList,
                    //'currentSubscriptionDetails' => $currentSubscriptionDetails->data,
                    'pageHeading' => 'MY VAULT',
                    'amount_due' => number_format($invoice->amount_due / 100, 2),
                    'currency'   => strtoupper($invoice->currency),
                    'line_item'  => $invoice->lines->data[0],
                    'period_start' => date('M d Y', $invoice->lines->data[0]->period->start),
                    'period_end'   => date('M d Y', $invoice->lines->data[0]->period->end),
                    'subscription_id' => $subscription->id,
                    'subscription_item_id' => $subscription->items->data[0]->id,
                    'target_price_id' => $targetPriceId,
                    'promoMessage'  => $promoMessage,
                    'promoSuccess'  => $promoSuccess
                ]; 
            //echo "<pre>";print_r($invoiceReturn);//exit;      

        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)//
              .view('subscription/SubscriptionUpgradeView',$data)
              .view('templates/footer_blank',$data);    
    } 
    public function payment_submit(){
        //echo "<pre>";print_r($_POST);

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

             $insertDataArray = array();

            $insertData = array(                 
                "user_id" => $_SESSION['employee_id'],
                "subscription_id" => $_POST['subceription_id'],
                "price" => $_POST['h_price'],        
                "payment_status" => 1,        
                "stripeToken" => $_POST['stripeToken'],        
                "stripeTokenType" => $_POST['stripeTokenType'],        
                "stripeEmail" => $_POST['stripeEmail'],        
                "added_by" => $_SESSION['employee_id']      
            );
            array_push($insertDataArray,$insertData);
                    
            $insert = array(
                "insertDataArray" => $insertDataArray,
                "table_name" => 'user_subscription'
            );
            
           $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert);

            return redirect()->to(base_url('Subscription')); exit;
    } 
    public function subscription_alert(){
        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }

        
        $apidata = array(
            "user_id" => $_SESSION['employee_id']
        ); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutUserStorageAvailability',$apidata);
        $storageAvailability = json_decode($result);
        //echo "<pre>";print_r($storageAvailability);exit;
        

        $data = [
            'title'   => 'SUBSCRIPTION :: '.PAGETITLE,
            'storageAvailability' => $storageAvailability->data,
            'pageHeading' => 'SUBSCRIPTION'
        ]; 
        
        return view('templates/header_with_avalable_size_info',$data)
              .view('templates/left_menu',$data)
              .view('subscription/SubscriptionAlertView',$data)     
              .view('templates/footer',$data);
    }   
}
