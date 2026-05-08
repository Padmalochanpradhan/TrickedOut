<?php

namespace App\Controllers;

class ManagePlan extends BaseController
{ 

    public function plan()
    { 
        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        } 
        
        $result=$this->curl->curl_call(APIURL.'TrickedOutSubscriptionMasterList','');
        $manageplan = json_decode($result);  
        //echo "<pre>";print_r($manageplan);exit;
        $actionList = array();

        $data = [
            'title'   => 'MANAGE PLAN :: '.PAGETITLE, 
            'manageplan' => $manageplan->data, 
            'pageHeading' => 'MANAGE PLAN'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('manageplan/plan',$data)               
              .view('templates/footer',$data);
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
