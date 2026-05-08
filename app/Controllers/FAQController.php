<?php

namespace App\Controllers;

class FAQController extends BaseController
{ 

    public function FAQ()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }

        if($_POST){                  
               $from =  $_POST['from'];
               $to =  $_POST['to'];
            }else{
               $from =  date('6/01/Y');
               $to =  date('m/d/Y',strtotime("+1 month"));

            }
            $apidata = array(
                "user_id" => $_SESSION['employee_id']
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutUserStorageAvailability',$apidata);
            $storageAvailability = json_decode($result);
            $apidata = array(
                "userId" => $_SESSION['employee_id']
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksList',$apidata);
            $trickList = json_decode($result);
            $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
            $trickCategoryList = json_decode($result);

            
        //echo "<pre>";print_r($trickCategoryList->data);exit;
        $actionList = array();

        $data = [
            'title'   => 'FAQ :: '.PAGETITLE,
            'fromdate' => $from,
            'todate' => $to,
            'trickList' => $trickList->data,
            'trickCategoryList' => $trickCategoryList->data,
            'storageAvailability' => $storageAvailability->data,
            'pageHeading' => 'FAQ'
        ]; 
        
        return view('templates/header_with_avalable_size_info',$data)
              .view('templates/left_menu',$data)
              .view('FAQ/FAQView',$data)
              .view('templates/footer',$data);
    } 
        
}
