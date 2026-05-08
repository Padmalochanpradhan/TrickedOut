<?php

namespace App\Controllers;
use App\Libraries\StripeService;
class ManageUser extends BaseController
{ 

    public function user()
    { 
        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        } 
        helper('phone');
        $apidata = array(
            "role" => 'User'
        ); 
        $stripeService = new StripeService();
        $response = $stripeService->getActiveAndTrialSubscriptions();
        //echo "<pre>";print_r($response);exit;
        $subscriptionData = $response['data'];
        $subscriptionMap = [];

        foreach ($subscriptionData as $sub) {
            $subscriptionMap[$sub['subscription_id']] = $sub;
        }
        //echo "<pre>";print_r($subscriptionData);exit;        
        $result=$this->curl->curl_call(APIURL.'TrickedOutUserList',$apidata);
        $userList = json_decode($result);  
        //echo "<pre>";print_r($userList);exit;
        $userListData = $userList->data;
        foreach ($userListData as &$user) {

            $stripeSubId = $user->stripe_subscription_id ?? null;

            if ($stripeSubId && isset($subscriptionMap[$stripeSubId])) {
                // Match found → attach full subscription info
                $user->subscription = $subscriptionMap[$stripeSubId];

                // Optional convenience fields
                $user->for_month = ($subscriptionMap[$stripeSubId]['interval'] === 'month')
                    ? $subscriptionMap[$stripeSubId]['amount']
                    : null;

                $user->for_year = ($subscriptionMap[$stripeSubId]['interval'] === 'year')
                    ? $subscriptionMap[$stripeSubId]['amount']
                    : null;

            } else {
                // No Stripe subscription
                $user->subscription = null;
                $user->for_month   = null;
                $user->for_year    = null;
            }
        }
        unset($user); // break reference

        //echo "<pre>";print_r($userListData);exit;
        $actionList = array();

        $data = [
            'title'   => 'MANAGE USER :: '.PAGETITLE, 
            'userList' => $userListData, 
            'pageHeading' => 'MANAGE USER'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('userlist/user',$data)               
              .view('templates/footer',$data);
    } 
    function format_phone($phone)
    {
        // Remove everything except digits
        $digits = preg_replace('/\D/', '', $phone);

        // Take last 10 digits
        $digits = substr($digits, -10);

        // Format
        return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $digits);
    }
    public function addupdate_plan(){
        //echo "<pre>"; print_r($_POST);exit;
        $subscription = $this->request->getVar('subscription');
        $start_date = date('Y-m-d', strtotime($this->request->getVar('start_date')));
        $end_date = date('Y-m-d', strtotime($this->request->getVar('end_date')));
        $volume = $this->request->getVar('volume');
        $price = $this->request->getVar('price');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        $status = $this->request->getVar('status');
        if($_POST['plan_id']){
            //echo "<pre>"; print_r($_POST);exit; 
            $data_file = array(
                "subscription" => $subscription,
                "start_date" => $start_date,
                "end_date" => $end_date,
                "volume_inGB" => $volume,
                "price" => $price,
                "for_month" => $month,
                "for_year" => $year,
                "status" => $status  
            );
            $update_data = array(
                "id_field_name" => "id",
                "id_field_value" => $_POST['plan_id'],
                "table_name" => "subscription_master",
                "updateData" => $data_file
            );
            $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data); 
              
        }else{
              
            $insertDataArray = array(); 
            $insertData = array(                 
                "subscription" => $subscription,
                "start_date" => $start_date,
                "end_date" => $end_date,        
                "volume_inGB" => $volume,
                "price" => $price,
                "for_month" => $month,
                "for_year" => $year,        
                "status" => $status      
            );
            array_push($insertDataArray,$insertData);                    
            $insert = array(
                "insertDataArray" => $insertDataArray,
                "table_name" => 'subscription_master'
            ); 
           $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert); 

        }
        return redirect()->to(base_url('plan')); exit;
    }
     

}
