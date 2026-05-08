<?php

namespace App\Controllers;

class ManageCategory extends BaseController
{ 

    public function Category()
    { 
        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        } 
        $apidata = array(
            "user_id" => $_SESSION['employee_id']
        ); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutUserStorageAvailability',$apidata);
        $storageAvailability = json_decode($result);
        //echo "<pre>";print_r($storageAvailability);exit;
        // if(!count($storageAvailability->data)){
        //     return redirect()->to(base_url('subscription_alert')); exit;  
        // }
        
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserCategoryList',$apidata);
        $CategoryList = json_decode($result);  
        //echo "<pre>";print_r($manageplan);exit;
        $actionList = array();

        $data = [
            'title'   => 'MANAGE CATEGORY :: '.PAGETITLE, 
            'CategoryList' => $CategoryList->data, 
            'storageAvailability' => $storageAvailability->data,
            'pageHeading' => 'MANAGE CATEGORY'
        ]; 
        
        return view('templates/header_with_avalable_size_info',$data)
              .view('templates/left_menu',$data)
              .view('managecategory/ManageCategoryView',$data)               
              .view('templates/footer',$data);
    } 

    public function addupdate_category(){
        //echo "<pre>"; print_r($_FILES);echo "<pre>"; print_r($_POST);exit;
        $category_name = $this->request->getVar('category_name');
        // $start_date = date('Y-m-d', strtotime($this->request->getVar('start_date')));
        // $end_date = date('Y-m-d', strtotime($this->request->getVar('end_date')));
         $status = $this->request->getVar('status');
        // $price = $this->request->getVar('price');
        // $month = $this->request->getVar('month');
        // $year = $this->request->getVar('year');
        // $status = $this->request->getVar('status');
        if($_POST['category_id']){
            //echo "<pre>"; print_r($_POST);exit; 
            $data_file = array(
                "category_name" => $category_name,
                "status" => $status  
            );
            $update_data = array(
                "id_field_name" => "id",
                "id_field_value" => $_POST['category_id'],
                "table_name" => "tricks_category",
                "updateData" => $data_file
            );
            $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data); 
              $insertId= $_POST['category_id']; 
            $this->session->setFlashdata("err_msg", "Category has been updated successfully.");
        }else{
              
            $insertDataArray = array(); 
            $insertData = array(                 
                "category_name" => $category_name,
                "added_by" => $_SESSION['employee_id'],
                "status" => $status      
            );
            array_push($insertDataArray,$insertData);                    
            $insert = array(
                "insertDataArray" => $insertDataArray,
                "table_name" => 'tricks_category'
            ); 
           $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert); 
           //echo "<pre>";print_r($result);exit;
           $response = json_decode($result, true);
            $insertId=$response['data']['insertId'];
            //$insertId = 1;
            $this->session->setFlashdata("err_msg", "Category added successfully.");


        }
        if($insertId){
            $category_icon=$_FILES['category_icon'];
            if($category_icon){
                $fileTmpPath = $category_icon['tmp_name'];
                $fileName = $category_icon['name'];
                //$fileSize = $file['size'];
                //$fileType = $file['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));  
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  
                $uploadFileDir = 'trick_categary_image/';
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                    $data_file = array(
                        "category_icon" => $newFileName
                    );
                    $update_data = array(
                        "id_field_name" => "id",
                        "id_field_value" => $insertId,
                        "table_name" => "tricks_category",
                        "updateData" => $data_file
                    );
                    $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);

                }
            }
            $category_banner=$_FILES['category_banner'];
            if($category_banner){
                $fileTmpPath = $category_banner['tmp_name'];
                $fileName = $category_banner['name'];
                //$fileSize = $file['size'];
                //$fileType = $file['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));  
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  
                $uploadFileDir = 'trick_categary_image_banner/';
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                    $data_file = array(
                        "category_banner" => $newFileName
                    );
                    $update_data = array(
                        "id_field_name" => "id",
                        "id_field_value" => $insertId,
                        "table_name" => "tricks_category",
                        "updateData" => $data_file
                    );
                    $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);

                }
            }
            $trick_default_icon=$_FILES['trick_default_icon'];
            if($category_banner){
                $fileTmpPath = $trick_default_icon['tmp_name'];
                $fileName = $trick_default_icon['name'];
                //$fileSize = $file['size'];
                //$fileType = $file['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));  
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  
                $uploadFileDir = 'trick_default_icon/';
                $dest_path = $uploadFileDir . $newFileName;

                if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                    $data_file = array(
                        "trick_default_icon" => $newFileName
                    );
                    $update_data = array(
                        "id_field_name" => "id",
                        "id_field_value" => $insertId,
                        "table_name" => "tricks_category",
                        "updateData" => $data_file
                    );
                    $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);

                }
            }
        }
        return redirect()->to(base_url('Category')); exit;
    }
     

}
