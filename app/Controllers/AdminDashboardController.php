<?php
namespace App\Controllers;
class AdminDashboardController extends BaseController
{ 
    public function Dashboard()
    {
        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        // if($_POST){
        //     //echo "<pre>";print_r($_POST);exit;                  
        //    $from =  $_POST['from'];
        //    $to =  $_POST['to'];
        // }else{
        //    $from =  date('6/01/Y');
        //    $to =  date('m/d/Y',strtotime("+1 month"));
        // }
        $searchTrickArray = array();
        $searchCategoryArray = array();
        $name = "";
        $artist = "";
        $user = 0;
        $catagory = "";
        $supplier = "";
        $uploaded_date_to = "";
        $uploaded_date_from = "";
        if($_POST){
            $searchCategoryArray = array(
                "t.name" => $_POST['name'],
                "t.artist" => $_POST['artist'],
                "t.added_by" => $_POST['user'],
                "t.category" => $_POST['catagory'],
                "t.supplier" => $_POST['supplier'],
                "uploaded_date_to" => $_POST['uploaded_date_to'],
                "uploaded_date_from" => $_POST['uploaded_date_from']
            );
            $name = $_POST['name'];
            $artist = $_POST['artist'];
            $user = $_POST['user'];
            $catagory = $_POST['catagory'];
            $supplier = $_POST['supplier'];
            if($_POST['uploaded_date_to']){
                $uploaded_date_to = date("Y-m-d", strtotime($_POST['uploaded_date_to']));
                
            }
            if($_POST['uploaded_date_from']){
                $uploaded_date_from =  date("Y-m-d", strtotime($_POST['uploaded_date_from']));
                
            }
            $searchTrickArray = array(
                "tri.name" => $_POST['name'],
                "tri.artist" => $_POST['artist'],
                "tri.added_by" => $_POST['user'],
                "tri.category" => $_POST['catagory'],
                "tri.supplier" => $_POST['supplier'],
                "uploaded_date_to" => $_POST['uploaded_date_to'],
                "uploaded_date_from" => $_POST['uploaded_date_from']
            );

        }
        //////////////////////
        $apidata = array();
        $result=$this->curl->curl_call(APIURL.'TrickedOutSupplierList',$apidata);
        $supplierList = json_decode($result);
        $apidata = array(
            "searchCategoryArray" => $searchCategoryArray
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
        $trickCategoryList = json_decode($result);
//echo "<pre>";print_r($trickCategoryList);exit;
        ///////////////////////
        $apidata = array(
            "searchArray" => $searchTrickArray
        ); 
        /*if(count($searchArray)){
        }else{
            $apidata = array(
            ); 
        }*/
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksList',$apidata);
        $trickList = json_decode($result);
        //echo "<pre>";print_r($trickList);exit;

        // $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
        // $trickCategoryList = json_decode($result);

        $apidata = array(
            "role" => 'User'
        ); 


        $result=$this->curl->curl_call(APIURL.'trickedoutuserlist',$apidata);
        $userList = json_decode($result);
        //echo "<pre>";print_r($userList);exit;
        $data = [
            'title'   => 'DASHBOARD :: '.PAGETITLE,
            // 'fromdate' => $from,
            // 'todate' => $to,
            'trickCategoryList' => $trickCategoryList->data,
            'supplierList' => $supplierList->data,
            'trickList' => $trickList->data,
            'userList' => $userList->data,
            'name' => $name,
            'artist' => $artist,
            'selected_user' => $user,
            'selected_catagory' => $catagory,
            'selected_supplier' => $supplier,
            'uploaded_date_to' => $uploaded_date_to,
            'uploaded_date_from' => $uploaded_date_from,
            'pageHeading' => 'DASHBOARD'
        ]; 
        //echo "<pre>";print_r($data);exit;
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('dashboard/AdminDashboardView',$data)
              .view('templates/footer',$data);
    } 
}
