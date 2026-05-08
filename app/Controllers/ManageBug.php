<?php

namespace App\Controllers;

class ManageBug extends BaseController
{ 

    public function ManageBug()
    {
//echo $this->request->uri->getSegment(2);exit;
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
        $apidata = array(); 
        //$result=$this->curl->curl_call(APIURL.'TrickedOutArtistList',$apidata);
        //$artistList = json_decode($result);
        if($_SESSION['employee_role']=="Admin"){
            $apidata = array(); 
        }else{
            $apidata = array(
                "userId" => $_SESSION['employee_id']
            ); 
        }
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetBugListByUser',$apidata);

        $bugList = json_decode($result);
        $apidata = array();
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetBugStatusList',$apidata);
        $bugStatusList = json_decode($result);

            
        //echo "<pre>";print_r($bugList);exit;
        $actionList = array();
        $bugId = $this->request->uri->getSegment(2);
        if($bugId){
            $bugapidata = array(
                "bugId" => $bugId
            ); 
            $result=$this->curl->curl_call(APIURL.'TrickedOutGetBugDetailsById',$bugapidata);
            $bugDetails = json_decode($result);
            //$data = ['bugDetails' => $bugDetails->data];
            $data = [
                'title'   => 'SUBMIT BUG :: '.PAGETITLE,
                'fromdate' => $from,
                'todate' => $to,
                'bugDetails' => $bugDetails->data,
                'bugList' => $bugList->data,
                'bugStatusList' => $bugStatusList->data,
                'pageHeading' => 'SUBMIT BUG'
            ]; 
        }else{
            $data = [
                'title'   => 'SUBMIT BUG :: '.PAGETITLE,
                'fromdate' => $from,
                'todate' => $to,
                //'artistList' => $artistList->data,
                'bugList' => $bugList->data,
                'bugStatusList' => $bugStatusList->data,
                'pageHeading' => 'SUBMIT BUG'
            ]; 
        }

        //echo "<pre>";print_r($data);exit;
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('bug/ManageBugView',$data)     
              //.view('fueldashboard/FuelDashboardJSFunction',$data)
              //.view('templates/CommonJSFunction',$data) 
              //.view('taskmodule/ManageTaskJSFunction',$data)             
              .view('templates/footer',$data);
    } 

    public function AddBugSubmit(){
        if($_POST){  
            //echo "<pre>";print_r($_FILES);echo "<pre>";print_r($_POST);exit;
              $title =  $_POST['title'];
               $notes =  $_POST['notes'];
               $status =  $_POST['status'];
               $bugId =  $_POST['bugId'];
               
               if($title){
                    $insertDataArray = array();
                    if($bugId){
                        $param = array(
                            "title" => $title,
                            "notes" => $notes,
                            "status" => $status
                        );  
                        //array_push($insertDataArray,$param);
                        $apidata = array(
                            "table_name" => "bug_list",
                            "id_field_name" => "id",
                            "id_field_value" => $bugId,
                            "updateData" => $param,
                        );
                        $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$apidata);
                        $bugReturn = json_decode($result);
                        $insertId = $bugId;
                    }else{
                        $param = array(
                            "title" => $title,
                            "notes" => $notes,
                            "status" => 1,
                            "added_by" => $_SESSION['employee_id']
                        );  
                        array_push($insertDataArray,$param);
                        $apidata = array(
                            "table_name" => "bug_list",
                            "insertDataArray" => $insertDataArray,
                        );
                        $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata);
                        $bugReturn = json_decode($result);

                        $insertId=$bugReturn->data->insertId;
                    }
                    //echo "<pre>";print_r($apidata);
                     //echo "<pre>";print_r($bugReturn);exit;
                    //$insertId = 1;
                    
                        $featured_image=$_FILES['featured_image'];
                        if($featured_image){
                            $fileTmpPath = $featured_image['tmp_name'];
                            $fileName = $featured_image['name'];
                            //$fileSize = $file['size'];
                            //$fileType = $file['type'];
                            $fileNameCmps = explode(".", $fileName);
                            $fileExtension = strtolower(end($fileNameCmps));  
                            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  
                            $uploadFileDir = 'trick_bug_image/';
                            $dest_path = $uploadFileDir . $newFileName;

                            if(move_uploaded_file($fileTmpPath, $dest_path))
                            {
                                $data_file = array(
                                    "file_name" => $newFileName
                                );
                                $update_data = array(
                                    "id_field_name" => "id",
                                    "id_field_value" => $insertId,
                                    "table_name" => "bug_list",
                                    "updateData" => $data_file
                                );
                            $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
                            }
                        }
                    return redirect()->to(base_url('Bug')); exit;

               }else{
                    return redirect()->to(base_url('Bug')); exit;        
               }
        }else{
            return redirect()->to(base_url('Bug')); exit;        
        }

    } 
    public function CategoryTricks()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
            $category = $this->request->uri->getSegment(2);
            $apidata = array(
                "userId" => $_SESSION['employee_id'],
                "category" => $category
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutGetTricksByCategory',$apidata);
            $trickList = json_decode($result);
//echo "<pre>";print_r($trickList->data);exit;
        if($_POST){                  
               $from =  $_POST['from'];
               $to =  $_POST['to'];
            }else{
               $from =  date('6/01/Y');
               $to =  date('m/d/Y',strtotime("+1 month"));

            }
            //$category = 1;
            $apidata = array(
                "category" => $category
            ); 

            //$result=$this->curl->curl_call(APIURL.'TrickedOutGetTricksByCategory',$apidata);
//trickList = json_decode($result);
            $result=$this->curl->curl_call(APIURL.'TrickedOutGetCategoryById',$apidata);
            $trickCategoryDetails = json_decode($result);

            
        //echo "<pre>";print_r($trickCategoryList->data);exit;
        $actionList = array();

        $data = [
            'title'   => 'CATEGORY TRICKS :: '.PAGETITLE,
            'fromdate' => $from,
            'todate' => $to,
            'trickList' => $trickList->data,
            'trickCategoryDetails' => $trickCategoryDetails->data,

            'pageHeading' => 'Category Tricks'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('categorytricks/CategoryTricksView',$data)            
              .view('templates/footer',$data);
    } 
    public function TricksDetails()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        $trickId = $this->request->uri->getSegment(2);
        $apidata = array(
            "userId" => $_SESSION['employee_id'],
            "trickId" => $trickId
        ); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutGetTrickDetailsById',$apidata);
        $trickDetails = json_decode($result);
        if(!count($trickDetails->data)){
            return redirect()->to(base_url('MyVault')); exit;
        }
        //echo "<pre>";print_r($trickDetails);exit;
        // $result=$this->curl->curl_call(APIURL.'TrickedOutArtistList',$apidata);
        // $artistList = json_decode($result);
        $result=$this->curl->curl_call(APIURL.'TrickedOutSupplierList',$apidata);
        $supplierList = json_decode($result);
        $apidata = array(
            "userId" => $_SESSION['employee_id']
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
        $trickCategoryList = json_decode($result);
        $apidata = array(
            "type" => "trick",
            "typeId" => $trickId
        ); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutgetDocumentListByTypeAndTypeId',$apidata);
        $trickFileList = json_decode($result);
        $pdf_flag = 0;
        $video_flag = 0;
        foreach($trickFileList->data AS $trickFile){
            //echo "<pre>";print_r($trickFileList);exit;
            if($trickFile->media_type=="pdf"){
                $pdf_flag = 1;
            }
            if($trickFile->media_type=="mp4"){
                $video_flag = 1;
            }
        }

        $data = [
            'title'   => 'TRICK DETAILS:: '.PAGETITLE,
            'documentType' => 'trick',
            'trickDetails' => $trickDetails->data,
            //'artistList' => $artistList->data,
            'supplierList' => $supplierList->data,
            'trickCategoryList' => $trickCategoryList->data,
            'trickFileList' => $trickFileList->data,
            'pdf_flag' => $pdf_flag,
            'video_flag' => $video_flag,
            'pageHeading' => 'TRICK DETAILS'
        ]; 
        //echo "<pre>";print_r($trickDetails);exit;
        return view('templates/header',$data) 
                .view('templates/left_menu',$data)                           
              .view('tricksdetails/TricksDetailsView',$data)     
              .view('documentupload/documentUploadJSFunction',$data)
              .view('documentupload/documentUploadModalHtml',$data)        
              .view('templates/footer',$data); 
    } 
    public function TrickFieldUpdate(){
        //echo "<pre>"; print_r($_POST);
        if($_POST['trick_id']){
            if(isset($_POST['trick_description'])){
                $data_file = array(
                    "description" => $_POST['trick_description']
                );
                $update_data = array(
                    "id_field_name" => "id",
                    "id_field_value" => $_POST['trick_id'],
                    "table_name" => "tricks",
                    "updateData" => $data_file
                );
                $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
            }
            if(isset($_POST['trick_notes'])){
                $data_file = array(
                    "notes" => $_POST['trick_notes']
                );
                $update_data = array(
                    "id_field_name" => "id",
                    "id_field_value" => $_POST['trick_id'],
                    "table_name" => "tricks",
                    "updateData" => $data_file
                );
                $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);

            }
            if(isset($_POST['trickInfo'])){
                $data_file = array(
                    "name" => $_POST['name'],
                    "artist" => $_POST['artist'],
                    "category" => $_POST['catagory'],
                    "supplier" => $_POST['supplier'],
                    "status" => $_POST['status']
                );
                $update_data = array(
                    "id_field_name" => "id",
                    "id_field_value" => $_POST['trick_id'],
                    "table_name" => "tricks",
                    "updateData" => $data_file
                );
                $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
                $supplierList = json_decode($result);

                //echo "<pre>";print_r($supplierList);exit;
            }
            if(isset($_POST['trickFeaturedImage'])){
                $featured_image=$_FILES['featured_image'];
                if($featured_image){
                    $fileTmpPath = $featured_image['tmp_name'];
                    $fileName = $featured_image['name'];
                    //$fileSize = $file['size'];
                    //$fileType = $file['type'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));  
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  
                    $uploadFileDir = 'trick_featured_image/';
                    $dest_path = $uploadFileDir . $newFileName;

                    if(move_uploaded_file($fileTmpPath, $dest_path))
                    {
                        $data_file = array(
                            "featured_image" => $newFileName
                        );
                        $update_data = array(
                            "id_field_name" => "id",
                            "id_field_value" => $_POST['trick_id'],
                            "table_name" => "tricks",
                            "updateData" => $data_file
                        );
                    $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
                    }
                }

            }
            return redirect()->to(base_url('TricksDetails/'.$_POST['trick_id'])); exit;  
        }
    }
    public function GetSupplierByName()
    {   
        try {
            $returnArray = array();
            $param = array(
             "name" => $_POST['name']
            );  
            $res=$this->curl->curl_call(APIURL.'TrickedOutSupplierList',$param);
            // $res=json_decode($res);
            // $returnArray['statusCode']=$res->statusCode;
            // $returnArray['data']=$res->data;
            echo $res;
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
    public function AddSupplier()
    {   
        try {
            $insertDataArray = array();
            $param = array(
             "name" => $_POST['name'],
             "website" => $_POST['website']
            );  
            array_push($insertDataArray,$param);
            $apidata = array(
                "table_name" => "supplier",
                "insertDataArray" => $insertDataArray,
            );
            $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata);            // $res=json_decode($res);
            // $returnArray['statusCode']=$res->statusCode;
            // $returnArray['data']=$res->data;
            echo $result;
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

}
