<?php

namespace App\Controllers;
use App\Libraries\DropboxClient;

class ManageTricks extends BaseController
{ 

    public function UploadTrick()
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
        if(isset($_POST['session_id'])){
            $session_id = $_POST['session_id'];
        }else{
            $session_id = date('YmdHis');
        }
            $apidata = array(
                "user_id" => $_SESSION['employee_id']
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutUserStorageAvailability',$apidata);
            $storageAvailability = json_decode($result);
            /// If no subscription
        if(!count($storageAvailability->data)){
            return redirect()->to(base_url('subscription_alert')); exit;  
        }

        $apidata = array(); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutSupplierList',$apidata);
        $supplierList = json_decode($result);
        $apidata = array(
            "userId" => $_SESSION['employee_id']
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
        $trickCategoryList = json_decode($result);

            
        $actionList = array();

        $data = [
            'title'   => 'UPLOAD TRICK : '.PAGETITLE,
            'fromdate' => $from,
            'todate' => $to,
            'session_id' => $session_id,
            'trickCategoryList' => $trickCategoryList->data,
            'supplierList' => $supplierList->data,
            'url_segment2' => $this->request->uri->getSegment(2),
            'storageAvailability' => $storageAvailability->data,
            'pageHeading' => 'UPLOAD TRICK'
        ]; 
        
        return view('templates/header_with_avalable_size_info',$data)
              .view('templates/left_menu',$data)
              .view('managetricks/UploadTrickView',$data)     
              .view('templates/footer',$data);
    } 
    public function UploadTrickStart()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        if(isset($_POST['session_id'])){
            $session_id = $_POST['session_id'];
        }else{
            $session_id = date('YmdHis');
        }
        $temp_table_data = [];
        $masterdata = [];
        $matched_count =0;
        $partially_matched_count =0;
        $backstage =0;
        $selected_trick_count =0;            
        $number_of_file =0;
        $file_process ='';
        $uploaded_file_count =0; 

       
        $apidata = array(); 

        //////////// Trick multiple file upload start ////////////////
       
        
   
        ///////////// Trick multiple file upload end /////////////// 
        $actionList = array();
        $data = [
            'title'   => 'UPLOAD TRICK : '.PAGETITLE, 
            'masterDataList' => $masterdata,
            'temp_table_data' => $temp_table_data,  
            'matched_count' => $matched_count,            
            'partially_matched_count' => $partially_matched_count,
            'backstage' => $backstage,
            'number_of_file' => $number_of_file,
            'session_id' => $session_id,
            'file_process' => $file_process,
            'uploaded_file_count' => $uploaded_file_count, 
            //'logData' => $logData,  
            'selected_trick_count' => $selected_trick_count,
            'pageHeading' => 'UPLOAD TRICK'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('managetricks/UploadTrickStartView',$data)        
             .view('templates/footer_blank',$data);
    } 
    public function UploadTrickProcess()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        $session_id = $this->request->uri->getSegment(2);
        $temp_table_data = [];
        $masterdata = [];
        $matched_count =0;
        $partially_matched_count =0;
        $backstage =0;
        $selected_trick_count =0;            
        $number_of_file =0;
        $file_process ='';
        $uploaded_file_count =0; 

       
        $apidata = array(); 

        //////////// Trick multiple file upload start ////////////////
            $apidata = array(
                "session_id" => $this->request->uri->getSegment(2)
            ); 
            $result1=$this->curl->curl_call(APIURL.'TrickedOutMasterDataList',$apidata);
            $masterDataList = json_decode($result1);
            $totalfileCount = count($masterDataList->data);
            $matchCount = 0 ;
            $totalFileSize = 0;
       foreach ($masterDataList->data as $key => $value) {
            if($value->status == 'Matched'){
                $matchCount++;
            }
            $totalFileSize +=$value->file_size;
       }
       $compArr = array(0,0,0,0);
       if($totalfileCount){
        $complitePercentge = round(($matchCount/$totalfileCount)*100);
        $complitePercentge1 = $complitePercentge;
         if($complitePercentge1>=25){
            $compArr[0]=25;
            $complitePercentge1 -= 25;
         }else{
            $compArr[0]=$complitePercentge1;
            $complitePercentge1 = 0;
         }
         if($complitePercentge1>=25){
            $compArr[1]=25;
            $complitePercentge1 -= 25;
         }else{
            $compArr[1]=$complitePercentge1;
            $complitePercentge1 = 0;
         }
         if($complitePercentge1>=25){
            $compArr[2]=25;
            $complitePercentge1 -= 25;
         }else{
            $compArr[2]=$complitePercentge1;
            $complitePercentge1 = 0;
         }
         if($complitePercentge1>=25){
            $compArr[3]=25;
            $complitePercentge1 -= 25;
         }else{
            $compArr[3]=$complitePercentge1;
            $complitePercentge1 = 0;
         }
       }


        //echo "<pre>";print_r($compArr);exit;
   
        ///////////// Trick multiple file upload end /////////////// 
        $actionList = array();
        $data = [
            'title'   => 'UPLOAD TRICK : '.PAGETITLE, 
            'masterDataList' => $masterdata,
            'temp_table_data' => $temp_table_data,  
            'matched_count' => $matched_count,            
            'partially_matched_count' => $partially_matched_count,
            'backstage' => $backstage,
            'compArr' => $compArr,
            'complitePercentge' => $complitePercentge,
            'totalfileCount' => $totalfileCount,
            'session_id' => $session_id,
            'totalFileSize' => round($totalFileSize),
            'uploaded_file_count' => $uploaded_file_count, 
            'number_of_file' => $totalfileCount,  
            'selected_trick_count' => $selected_trick_count,
            'pageHeading' => 'UPLOAD TRICK'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('managetricks/UploadTrickProcessView',$data)        
             .view('templates/footer_blank',$data);
    } 
    public function UploadTrickComplete()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        $dropboxClient = new \App\Libraries\DropboxClient();
        $session_id = $this->request->uri->getSegment(2);

        //////////// Trick multiple file upload start ////////////////
        $apidata = array(); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutSupplierList',$apidata);
        $supplierList = json_decode($result);
        $apidata = array(
            "userId" => $_SESSION['employee_id']
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
        $trickCategoryList = json_decode($result);
        $apidata = array(
            "session_id" => $session_id
        ); 
        $result1=$this->curl->curl_call(APIURL.'TrickedOutMasterDataList',$apidata);
        $masterDataList = json_decode($result1);
        $masterdata = $masterDataList->data;
       // echo "<pre>";print_r($masterDataList);exit;
        $totalfileCount = count($masterDataList->data);
        $matchCount = 0 ;
        $totalFileSize = 0;
        $duplicateCount = 0;
        $backstageCount = 0;
        $trickFileLinkArray = array();
       foreach ($masterDataList->data as $key => $value) {
            if($value->record_status == 1){
                $matchCount++;
            }elseif($value->match_trick_id != ''){
                $duplicateCount++;
            }elseif($value->status == 'Backstage'){
                $backstageCount++;
            }
            $totalFileSize +=$value->file_size;


            $directLink = $dropboxClient->getDirectLink($value->full_fileName);
            //$trickFile->directLink =$directLink;
            array_push($trickFileLinkArray,$directLink);

       }
       //echo "<pre>";print_r($trickFileLinkArray);exit;
       ///////////// Trick multiple file upload end /////////////// 
        $actionList = array();
        $data = [
            'title'   => 'UPLOAD TRICK : '.PAGETITLE, 
            'masterDataList' => $masterdata,
            //'temp_table_data' => $temp_table_data,  
            'matchCount' => $matchCount,            
            'totalFileSize' => $totalFileSize,
            'trickFileLinkArray' => $trickFileLinkArray,
            'duplicateCount' => $duplicateCount,
            'backstageCount' => $backstageCount,
            'session_id' => $session_id,
            'trickCategoryList' => $trickCategoryList->data,
            'supplierList' => $supplierList->data,
            'number_of_file' => $totalfileCount,  
            'pageHeading' => 'UPLOAD TRICK'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('managetricks/UploadTrickCompleteView',$data)        
              .view('templates/add_trick_pupup_model',$data)
             .view('templates/footer_blank',$data);
    } 
    public function TrickBackstage()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        $dropboxClient = new \App\Libraries\DropboxClient();

        if(isset($_POST['session_id'])){
            $session_id = $_POST['session_id'];
        }else{
            $session_id = date('YmdHis');
        }
        $session_id = "";
        $temp_table_data = [];
        $masterdata = [];
        $matched_count =0;
        $partially_matched_count =0;
        $backstage =0;
        $selected_trick_count =0;            
        $number_of_file =0;
        $file_process ='';
        $uploaded_file_count =0; 

       
        $apidata = array(); 

        //////////// Trick multiple file upload start ////////////////
        $apidata = array(); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutSupplierList',$apidata);
        $supplierList = json_decode($result);
        $apidata = array(
            "userId" => $_SESSION['employee_id']
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
        $trickCategoryList = json_decode($result);
       
        $apidata = array(
            "userId" => $_SESSION['employee_id']
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetBackstageListByUser',$apidata);
        $backstageList = json_decode($result);
        //echo "<pre>";print_r($backstageList);exit;
        $trickFileLinkArray = array();
        foreach ($backstageList->data as $key => $value) {
            $directLink = $dropboxClient->getDirectLink($value->full_fileName);
            array_push($trickFileLinkArray,$directLink);
            //echo $value->full_fileName;
        }   
        //echo "<pre>";print_r($trickFileLinkArray);exit;
        ///////////// Trick multiple file upload end /////////////// 
        $actionList = array();
        $data = [
            'title'   => 'TRICK BACKSTAGE : '.PAGETITLE, 
            'masterDataList' => $masterdata,
            'temp_table_data' => $temp_table_data,  
            'matched_count' => $matched_count,  
            'backstageList' => $backstageList->data,         
            'partially_matched_count' => $partially_matched_count,
            'backstage' => $backstage,
            'number_of_file' => $number_of_file,
            'session_id' => $session_id,
            'file_process' => $file_process,
            'uploaded_file_count' => $uploaded_file_count, 
            'trickCategoryList' => $trickCategoryList->data,
            'supplierList' => $supplierList->data,
            'trickFileLinkArray' => $trickFileLinkArray,  
            'selected_trick_count' => $selected_trick_count,
            'pageHeading' => 'UPLOAD TRICK'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('managetricks/TrickBackstageView',$data)        
              .view('templates/add_trick_pupup_model',$data)
             .view('templates/footer_blank',$data);
    } 
 
    public function UploadTrickMultiple()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        if(isset($_POST['session_id'])){
            $session_id = $_POST['session_id'];
        }else{
            $session_id = date('YmdHis');
        }
        $temp_table_data = [];
        $masterdata = [];
        $matched_count =0;
        $partially_matched_count =0;
        $backstage =0;
        $selected_trick_count =0;            
        $number_of_file =0;
        $file_process ='';
        $uploaded_file_count =0;
        ////////////////////////////////////////////
            $apidata = array(
                "user_id" => $_SESSION['employee_id']
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutUserStorageAvailability',$apidata);
            $storageAvailability = json_decode($result);
            /// If no subscription
        if(!count($storageAvailability->data)){
            return redirect()->to(base_url('subscription_alert')); exit;  
        }
//echo "<pre>1";print_r($_POST);exit;
        /*if(isset($_POST['process'])){
        
            
            $ids = implode(',',$_POST['filelist']);  
            $sourceIds = implode(", ", array_filter($_POST['sourceList']));
            $apidata = array(
                "ids" => $ids,
                "source_ids" => $sourceIds
            ); 
            $result1=$this->curl->curl_call(APIURL.'TrickedOutMasterDataList',$apidata);
            $masterDataList = json_decode($result1);
            
            //echo "<pre>";print_r($masterDataList);exit;
            $insertDataArray1 = array();
            $j=0;
            $insert_count = 0;
            $update_count = 0;
            foreach ($masterDataList->data as $key => $value) {
                $j++;
                //echo "<pre>";print_r($value);
                if(!$value->match_trick_id){
                    $insert_count++;
                    $data_array = array(
                        "name" => $value->filename,
                        "description" => $value->Description,
                        "notes" => $value->Description,
                        "artist" => $value->Artist,
                        "catagory" => 26,
                        "supplier" => 0,
                        "purchased_date" => date('Y-m-d'),
                        "favorite_flag" => 0,
                        "added_by" => $_SESSION['employee_id']
                    );
                   //echo "<pre>";print_r($data_array);
                    $result=$this->curl->curl_call(APIURL.'TrickedOutCreateTrick',$data_array);
                    $trickCreateReturn = json_decode($result); 
                    //echo "<pre>";print_r($trickCreateReturn);exit;
                    $insertId=$trickCreateReturn->results->insertId;
                }else{
                    $update_count++;
                    $insertId=$value->match_trick_id;
                }


                if($insertId){
                    $source = 'trick_upload_file/'.$value->full_fileName; 
                    $destination = "trick_files/".$value->full_fileName; 
                    copy($source, $destination);
                    unlink($source);
                    $insertData1 = array(
                        "type" => 'trick',
                        "type_id" => $insertId,
                        "file_name" => $value->full_fileName,
                        "added_by" => $_SESSION['employee_id'],
                        "media_type" => $value->extension
                    );
                    array_push($insertDataArray1,$insertData1);
                }  

                $data_file = array(
                    "record_status" => 1,
                    "source_id"=> $value->source_id
                );
                $update_data = array(
                    "id_field_name" => "id",
                    "id_field_value" => $value->id,
                    "table_name" => "temp_master_data",
                    "updateData" => $data_file
                );
                $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
            }
            $uploaded_file_count = $j;
        

            /////////// Create Trick Log Start ////////////////          
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 3 - Tricks selected to upload to TrickedOut - '.$uploaded_file_count.' Files','INFO');
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 3 - Tricks created into TrickedOut - '.$insert_count.' Tricks','INFO');
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 3 - Tricks updated into TrickedOut - '.$update_count.' Tricks','INFO');
            /////// Log End ///////////////

            $documentapidata = array(
                "table_name" => "document",
                "insertDataArray" => $insertDataArray1,
            );
            $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$documentapidata);
            $sessionapidata = array(
                "session_id" => $session_id
            );
            //echo "<pre>";print_r($sessionapidata);
            $result1=$this->curl->curl_call(APIURL.'TrickedOutMasterDataList',$sessionapidata);
            $masterDataList = json_decode($result1);
            //echo "<pre>";print_r($masterDataList);exit;
            $masterdata = $masterDataList->data; 
            $value_id ='';
            foreach ($masterdata as $key => $value) {
                if($value->id != $value_id){
                    $number_of_file++;
                    if($value->status == 'Partially Matched'){
                        $partially_matched_count++;
                    }
                }
                $value_id = $value->id;
                if($value->status == 'Matched'){
                    $matched_count++;
                }                
                if($value->status == 'Backstage'){
                    $backstage++;
                }
                if($value->status == 'Matched' && $value->match_trick_id == ''){
                    $selected_trick_count++;
                }                 
            } 
            /////////// Create Trick Log Start ////////////////          
            $this->insertActivateLog($session_id,'UPLOAD',' END - Upload Process','INFO'); 
            
            $file_process=1; 
            $res=$this->curl->curl_call(APIURL.'TrickedOutgetLogList',$sessionapidata);
            $logList = json_decode($res);
            $logData = $logList->data;

        }   */  
        $apidata = array(); 

        //////////// Trick multiple file upload start ////////////////
       
        
        if(isset($_POST['uploadedFiles'])){
            //echo "<pre>";print_r($_POST);exit;

            $file_process ='';
            $uploadedFiles = json_decode($_POST['uploadedFiles'], true);
            $uploadedFileSize = json_decode($_POST['uploadedFileSize'], true);
            $fileName = json_decode($_POST['fileName'], true);
            //$session_id = date('YmdHis');
            $uploadDir = 'trick_upload_file/';
            $insertDataArray = array(); 
            //Process Start
            $i=0;
            foreach($uploadedFiles AS $file){
                $fileNameDetails = $fileName[$i];
                $nameWithoutExt = pathinfo($fileNameDetails, PATHINFO_FILENAME);
                $extension = pathinfo($fileNameDetails, PATHINFO_EXTENSION);
                $file_name = $nameWithoutExt; // Without extension
                $extension = $extension; // Extension only
                $fileSizeMB= $uploadedFileSize[$i]/(1024 * 1024);

                /*$fileFullPath= $uploadDir . $file;
                $fileInfo = pathinfo($fileFullPath);
                $newFileName = $file_name . "_".$session_id.".".$extension;
                $newFileFullPath = $uploadDir . $newFileName;
                $fileSizeMB=filesize($fileFullPath)/(1024 * 1024);
//echo "<pre>2";print_r($fileInfo);exit;
                rename($fileFullPath, $newFileFullPath);*/
                $newFileName = $uploadedFiles[$i];

                $insertData = array(
                    "filename" => $file_name,
                    "extension" => $extension,
                    "file_status" => '',
                    "added_by" => $_SESSION['employee_id'],
                    "effective_column" => '',
                    "full_fileName" => $newFileName,
                    "file_size" => $fileSizeMB,
                    "added_date" => date('Y-m-d H:i:s'),
                    "source_id" => 0,
                    "session_id" => $session_id
                );
                array_push($insertDataArray,$insertData); 
                $i++;
            }

            $apidata = array(
                "table_name" => "temp_master_data",
                "insertDataArray" => $insertDataArray,
            );
            $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata);             

            $apidata = array(
                "session_id" => $session_id
            ); 

            ////////// Update temp master table //////
            $result1=$this->curl->curl_call(APIURL.'TrickedOutMasterDataList',$apidata);
            $masterDataList = json_decode($result1);
            //echo "<pre>";print_r($masterDataList);exit;
            $masterdata = $masterDataList->data;
            $value_id ='';
            $idStr = "";
            $sourceStr = "";
            foreach ($masterdata as $key => $value) {
             //echo "<pre>";print_r($masterDataList);exit;
                if($value->id != $value_id){
                    $number_of_file++;
                    if($value->status == 'Partially Matched'){
                        $partially_matched_count++;
                    }
                }

                $value_id = $value->id;
                if($value->status == 'Matched'){
                    $matched_count++;
                    $idStr .= $value_id.",";
                    $sourceStr .= $value->source_id.",";
                    //echo " ids = ".$idStr;
                }                
                if($value->status == 'Backstage'){
                    $backstage++;
                }
                if($value->status == 'Matched' && $value->match_trick_id == ''){
                    $selected_trick_count++;
                }                 
            }  
            $idStr=rtrim($idStr, ',');
            $sourceStr=rtrim($sourceStr, ',');
        //echo " {ids} = ".$idStr;
            /////////// Create Trick Log Start ////////////////          
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 2 - Matching started - '.$number_of_file.' Files','INFO');
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 2 - Exact Matched - '.$matched_count.' Files','INFO');
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 2 - Partially Matched - '.$partially_matched_count.' Files','INFO');
            /////// Log End /////////////// 


            ////////////////Insert start///////////////////
            $apidata = array(
                "ids" => $idStr,
                "source_ids" => $sourceStr
            ); 
            //echo "<pre>";print_r($apidata);
            $result1=$this->curl->curl_call(APIURL.'TrickedOutMasterDataList',$apidata);
            $masterDataList = json_decode($result1);
           // echo "<pre>";print_r($apidata);
            //echo "<pre>";print_r($masterDataList);exit;
            $insertDataArray1 = array();
            $trickCategorysArray = array();
            $j=0;
            $insert_count = 0;
            $update_count = 0;
            foreach ($masterDataList->data as $key => $value) {
                $j++;
                //echo "<pre>";print_r($value);

            //echo "<pre>";print_r($_POST);exit;
                if(!$value->match_trick_id){
                    $insert_count++;
                    $data_array = array(
                        "name" => $value->filename,
                        "description" => $value->Description,
                        "notes" => $value->Description,
                        "artist" => $value->Artist,
                        "catagory" => 26,
                        "supplier" => 0,
                        "purchased_date" => date('Y-m-d'),
                        "favorite_flag" => 0,
                        "added_by" => $_SESSION['employee_id']
                    );
                   //echo "<pre>";print_r($data_array);
                    $result=$this->curl->curl_call(APIURL.'TrickedOutCreateTrick',$data_array);
                    $trickCreateReturn = json_decode($result); 
                    //echo "<pre>";print_r($trickCreateReturn);exit;
                    $insertId=$trickCreateReturn->results->insertId;
                }else{
                    $update_count++;
                    $insertId=$value->match_trick_id;
                }


                if($insertId){
                    //$source = 'trick_upload_file/'.$value->full_fileName; 
                    //$destination = "trick_files/".$value->full_fileName; 
                    //copy($source, $destination);
                    //unlink($source);
                    $insertData1 = array(
                        "type" => 'trick',
                        "type_id" => $insertId,
                        "file_name" => $value->full_fileName,
                        "file_size" => $value->file_size,
                        "added_by" => $_SESSION['employee_id'],
                        "media_type" => $value->extension
                    );
                    array_push($insertDataArray1,$insertData1);
                    ///////////////////Category Assign
                    //$categoryArray = explode(",", $value->Tag);
                    // Step 1: Split the string
                    $array = array_map('trim', explode(',', $value->Tag));

                    // Step 2: Wrap each value in single quotes
                    $quoted = array_map(function($item) {
                        return "'" . addslashes($item) . "'";
                    }, $array);

                    // Step 3: Join back into a string 
                    $inClause = implode(',', $quoted);
                    $categoryAPIPara = array(
                        'categoryNameStr' => $inClause,
                        'userId' => $_SESSION['employee_id']
                    );
                    //echo "<pre>";print_r($categoryAPIPara);
                    $result=$this->curl->curl_call(APIURL.'TrickedOutGetCategoryByNames',$categoryAPIPara);
                    $trickCategorys = json_decode($result);
                                        //echo "<pre>";print_r($trickCategorys);exit;

                    $trickCategoryList = $trickCategorys->data;
                    
                    $categoryFlag = 0;
                    foreach($trickCategoryList AS $trickCategory){
                        $categoryArr = array(
                        "trick_id" => $insertId,
                        "category_id" => $trickCategory->id,
                        "added_by" => $_SESSION['employee_id']
                        );
                        array_push($trickCategorysArray,$categoryArr);
                        $categoryFlag = 1;
                    }
                    if($categoryFlag == 0){
                        $categoryArr = array(
                        "trick_id" => $insertId,
                        "category_id" => 26,
                        "added_by" => $_SESSION['employee_id']
                        );
                        array_push($trickCategorysArray,$categoryArr);

                    }

                    //echo "<pre>";print_r($trickCategorys);exit; 

                }  

                $data_file = array(
                    "record_status" => 1,
                    "source_id"=> $value->source_id
                );
                $update_data = array(
                    "id_field_name" => "id",
                    "id_field_value" => $value->id,
                    "table_name" => "temp_master_data",
                    "updateData" => $data_file
                );
                $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
            }
            $uploaded_file_count = $j;
        

            /////////// Create Trick Log Start ////////////////          
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 3 - Tricks selected to upload to TrickedOut - '.$uploaded_file_count.' Files','INFO');
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 3 - Tricks created into TrickedOut - '.$insert_count.' Tricks','INFO');
            $this->insertActivateLog($session_id,'UPLOAD',' STEP 3 - Tricks updated into TrickedOut - '.$update_count.' Tricks','INFO');
            /////// Log End ///////////////

            $documentapidata = array(
                "table_name" => "document",
                "insertDataArray" => $insertDataArray1,
            );
            $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$documentapidata);

            /////Category mapping insert 
            $categoryapidata = array(
                "table_name" => "trick_category_mapping",
                "insertDataArray" => $trickCategorysArray,
            );
            $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$categoryapidata);
             return redirect()->to(base_url('UploadTrickProcess/'.$session_id)); exit;     


            /////////////////////////////////////////////////
        }
    
        ///////////// Trick multiple file upload end /////////////// 
        $actionList = array();
        $data = [
            'title'   => 'UPLOAD TRICK : '.PAGETITLE, 
            'masterDataList' => $masterdata,
            'temp_table_data' => $temp_table_data,  
            'matched_count' => $matched_count,            
            'partially_matched_count' => $partially_matched_count,
            'backstage' => $backstage,
            'number_of_file' => $number_of_file,
            'session_id' => $session_id,
            'file_process' => $file_process,
            'uploaded_file_count' => $uploaded_file_count, 
           // 'logData' => $logData,  
            'selected_trick_count' => $selected_trick_count,
            'pageHeading' => 'UPLOAD TRICK'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('managetricks/MultipleUploadTrickView',$data)        
             .view('templates/footer_blank',$data);
    } 
    public function UploadTrick2()
    {
//echo $this->request->uri->getSegment(2);exit;
        if($_POST['purchased_date']){
            $_POST['purchased_date'] = date("Y-m-d", strtotime($_POST['purchased_date']));
        }
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


            
       // echo "<pre>";print_r($trickCategoryList->data);exit;
        $actionList = array();

        $data = [
            'title'   => 'UPLOAD TRICK : '.PAGETITLE,
            'fromdate' => $from,
            'todate' => $to,
            'url_segment2' => $this->request->uri->getSegment(2),
            'pageHeading' => 'UPLOAD TRICK'
        ]; 
        
        return view('templates/left_menu',$data)
              .view('managetricks/UploadTrickView2',$data)
             .view('documentupload/documentUploadJSFunction',$data)
              .view('documentupload/documentUploadModalHtml',$data)
     
              //.view('fueldashboard/FuelDashboardJSFunction',$data)
              //.view('templates/CommonJSFunction',$data) 
              //.view('taskmodule/ManageTaskJSFunction',$data)             
              .view('templates/footer',$data);
    } 

    // public function UploadTrickMultipleSubmit(){        
    //     if($_POST){    
    //         // echo "<pre>";print_r($_POST);
    //         // echo "<pre>";print_r($_FILES);exit;  
    //         $trickfile = $_FILES['trickfile']['name'];
    //         $data_array =array();
    //         foreach ($trickfile as $key => $value) {
    //             $filenameWithoutExt = pathinfo($value, PATHINFO_FILENAME);
    //             $apidata = array(
    //                 "trick" => $filenameWithoutExt
    //             ); 
    //             $result=$this->curl->curl_call(APIURL.'TrickedOutTrickList',$apidata);
    //             $trickList = json_decode($result);
    //             if(!empty($trickList->data)){
    //                 $data['list'][$key]['name']=$filenameWithoutExt;
    //                 if($trickList->data[0]->matched_field == 'name'){
    //                    $status='Matched';
    //                 }else{
    //                    $status='Partially Matched'; 
    //                 }
    //                 $data['list'][$key]['status']=$status;
    //                 $data['list'][$key]['matched_field']=$trickList->data[0]->matched_field;
    //             }else{
    //                 $data['list'][$key]['name']=$filenameWithoutExt; 
    //                 $data['list'][$key]['status']='Not Matched';                     
    //                 $data['list'][$key]['matched_field']='';
    //             }                
                 
    //         } echo "<pre>";print_r($data);exit;
    //     }
    // }
public function BackstageUploadTrickSubmit(){
    //echo "<pre>";print_r($_POST);echo "<pre>";print_r($_FILES);exit;
    //$catagory =  $_POST['catagory'];

    // foreach($catagory AS $oneCategory){
    //     echo $oneCategory."<br>";
    // }
    // exit;
    //echo "<pre>";print_r($_POST);exit;
        if($_POST){  
            //echo "111<pre>";print_r($_FILES);echo "222<pre>";print_r($_POST);
            //echo "<pre>";print_r($_POST['trickfile'][0]);
            //exit;
            if(isset($_POST['purchased_date'])){
                $_POST['purchased_date'] = date("Y-m-d", strtotime($_POST['purchased_date']));
            }else{
               $_POST['purchased_date'] = ''; 
            }                 
                $name =  $_POST['name'];
               $description =  $_POST['description'];
               $artist =  $_POST['artist'];
               $catagory =  $_POST['catagory'];
               $supplier =  $_POST['supplier'];
               $purchased_date =  $_POST['purchased_date'];
               $favorite_flag =  0;
               //$notes =  $_POST['notes'];
               if($name){
                    $data_array = array(
                        "name" => $name,
                        "description" => $description,
                        //"notes" => $notes,
                        "artist" => $artist,
                        //"catagory" => $catagory,
                        "supplier" => $supplier,
                        //"purchased_date" => $purchased_date,
                        "favorite_flag" => 0,
                        "added_by" => $_SESSION['employee_id'],
                    );
                    $result=$this->curl->curl_call(APIURL.'TrickedOutCreateTrick',$data_array);
                    $trickCreateReturn = json_decode($result);
                   // echo "<pre>";print_r($trickCreateReturn);exit;
                    $insertId=$trickCreateReturn->results->insertId;
//echo "<pre>";print_r($trickCreateReturn);exit;                    
                    //$insertId = 1;
                    if($insertId){
                        $this->session->setFlashdata("err_msg", "Trick added successfully.");

                        /////////Multiple category//////////////////
                        $insertCategoryArray = array();
                        foreach($catagory AS $oneCategory){
                            $insertCategory = array(
                                "trick_id" => $insertId,
                                "category_id" => $oneCategory,
                                "added_by" => $_SESSION['employee_id']
                            );
                            array_push($insertCategoryArray,$insertCategory);
                        }
                        if(count($insertCategoryArray)){
                            $apidata = array(
                                "table_name" => "trick_category_mapping",
                                "insertDataArray" => $insertCategoryArray,
                            );
                            $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata); 
                        } 
                        ////////////////////////////////////
                        $apidata = array(
                            "id" => $_POST['backstage_id']
                        ); 
                        $result1=$this->curl->curl_call(APIURL.'TrickedOutGetBackstageDetailsByID',$apidata);
                        $backstageDataList = json_decode($result1);
                        $backstageData = $backstageDataList->data;
                        if(count($backstageData)){
                            /*$source = 'trick_upload_file/'.$backstageData[0]->full_fileName; 
                            $destination = "trick_files/".$backstageData[0]->full_fileName; 
                            copy($source, $destination);
                            unlink($source);*/
                            $insertDataArray = array();
                            $insertData = array(
                                "type" => 'trick',
                                "type_id" => $insertId,
                                "file_name" => $backstageData[0]->full_fileName,
                                "added_by" => $_SESSION['employee_id'],
                                "media_type" => $backstageData[0]->extension,
                                "file_size" => $backstageData[0]->file_size
                            );
                            array_push($insertDataArray,$insertData);
                            if(count($insertDataArray)){
                                $apidata = array(
                                    "table_name" => "document",
                                    "insertDataArray" => $insertDataArray,
                                );
                               $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata); 
                            }                            
                        }
                        //echo "<pre>";print_r($backstageDataList);exit;
                       /* $trickfile=$_FILES['trickfile'];
                        $i = 0;

                        //echo "<pre>";print_r($_POST['uploadedFiles'][0]);exit;
                        $fileArray = json_decode($_POST['uploadedFiles'], true);
                        $insertDataArray = array();
                        foreach($fileArray AS $oneFileName){
                            $fileNameCmps = explode(".", $oneFileName);
                            $fileExtension = strtolower(end($fileNameCmps));
                                $insertData = array(
                                    "type" => 'trick',
                                    "type_id" => $insertId,
                                    "file_name" => $oneFileName,
                                    "added_by" => $_SESSION['employee_id'],
                                    "media_type" => $fileExtension
                                );
                                array_push($insertDataArray,$insertData);
                        }

                        if(count($insertDataArray)){
                            $apidata = array(
                                "table_name" => "document",
                                "insertDataArray" => $insertDataArray,
                            );
                           $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata); 
                        }*/

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
                                    "id_field_value" => $insertId,
                                    "table_name" => "tricks",
                                    "updateData" => $data_file
                                );
                            $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
                            }
                        }
                      ///////// Trick backstage to process
                $data_file = array(
                    "record_status" => 1
                );
                $update_data = array(
                    "id_field_name" => "id",
                    "id_field_value" => $_POST['backstage_id'],
                    "table_name" => "temp_master_data",
                    "updateData" => $data_file
                );
            $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
  
                    }
    //echo "<pre>";print_r($_POST);echo "<pre>";print_r($_FILES);exit;
                    if($_POST['session_id']){
                        return redirect()->to(base_url('UploadTrickComplete/'.$_POST['session_id'])); exit;
                    }else{
                        return redirect()->to(base_url('TrickBackstage/')); exit;
                    }
                    return redirect()->to(base_url('UploadTrickComplete/'.$_POST['session_id'])); exit;
               }else{
                    return redirect()->to(base_url('UploadTrick')); exit;        
               }
        }else{
            return redirect()->to(base_url('UploadTrick')); exit;        
        }


}
    public function UploadTrickSubmit(){
        if($_POST){  
            //echo "111<pre>";print_r($_FILES);echo "222<pre>";print_r($_POST);
            //echo "<pre>";print_r($_POST['trickfile'][0]);
            //exit;
            if($_POST['purchased_date']){
                $_POST['purchased_date'] = date("Y-m-d", strtotime($_POST['purchased_date']));
            }                 
              $name =  $_POST['name'];
               $description =  $_POST['description'];
               $artist =  $_POST['artist'];
               $catagory =  $_POST['catagory'];
               $supplier =  $_POST['supplier'];
               $purchased_date =  $_POST['purchased_date'];
               $favorite_flag =  $_POST['favorite_flag'];
               //$notes =  $_POST['notes'];
               if($name){
                    $data_array = array(
                        "name" => $name,
                        "description" => $description,
                        //"notes" => $notes,
                        "artist" => $artist,
                        //"catagory" => $catagory,
                        "supplier" => $supplier,
                        "purchased_date" => $purchased_date,
                        "favorite_flag" => $favorite_flag,
                        "added_by" => $_SESSION['employee_id'],
                    );
                    $result=$this->curl->curl_call(APIURL.'TrickedOutCreateTrick',$data_array);
                    $trickCreateReturn = json_decode($result);
                   // echo "<pre>";print_r($trickCreateReturn);exit;
                    $insertId=$trickCreateReturn->results->insertId;
                    //$insertId = 1;
                    if($insertId){
                        $catagory =  $_POST['catagory'];

                        /////////Multiple category//////////////////
                        $insertCategoryArray = array();
                        foreach($catagory AS $oneCategory){
                            $insertCategory = array(
                                "trick_id" => $insertId,
                                "category_id" => $oneCategory,
                                "added_by" => $_SESSION['employee_id']
                            );
                            array_push($insertCategoryArray,$insertCategory);
                        }
                        if(count($insertCategoryArray)){
                            $apidata = array(
                                "table_name" => "trick_category_mapping",
                                "insertDataArray" => $insertCategoryArray,
                            );
                            $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata); 
                        } 
                        ////////////////////////////////////



                        $trickfile=$_FILES['trickfile'];
                        $i = 0;

                        //echo "<pre>";print_r($_POST['uploadedFiles'][0]);exit;
                        $fileArray = json_decode($_POST['uploadedFiles'], true);
                        $fileSizeArray = json_decode($_POST['uploadedFileSize'], true);
                        $insertDataArray = array();
                        $ii=0;
                        foreach($fileArray AS $oneFileName){
                            $fileNameCmps = explode(".", $oneFileName);
                            $fileExtension = strtolower(end($fileNameCmps));
                                $insertData = array(
                                    "type" => 'trick',
                                    "type_id" => $insertId,
                                    "file_name" => $oneFileName,
                                    "file_size" => $fileSizeArray[$i],
                                    "added_by" => $_SESSION['employee_id'],
                                    "media_type" => $fileExtension
                                );
                                array_push($insertDataArray,$insertData);
                        }

                        if(count($insertDataArray)){
                            $apidata = array(
                                "table_name" => "document",
                                "insertDataArray" => $insertDataArray,
                            );
                           $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata); 
                        }

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
                                    "id_field_value" => $insertId,
                                    "table_name" => "tricks",
                                    "updateData" => $data_file
                                );
                            $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
                            }
                        }
                    }
                    return redirect()->to(base_url('UploadTrick/added')); exit;
               }else{
                    return redirect()->to(base_url('UploadTrick')); exit;        
               }
        }else{
            return redirect()->to(base_url('UploadTrick')); exit;        
        }

    }  
    public function CategoryTricks()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
            $category = $this->request->uri->getSegment(2);
            $apidata = array(
                "user_id" => $_SESSION['employee_id']
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutUserStorageAvailability',$apidata);
            $storageAvailability = json_decode($result);
            $apidata = array(
                "userId" => $_SESSION['employee_id'],
                "category" => $category,
                "multipleCategoryFlag" => 1
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutGetTricksByCategory',$apidata);
            $trickList = json_decode($result);
//echo "<pre>";print_r($trickList);exit;
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
            'title'   => 'CATEGORY TRICKS : '.PAGETITLE,
            'fromdate' => $from,
            'todate' => $to,
            'category' => $category,
            'trickList' => $trickList->data,
            'trickCategoryDetails' => $trickCategoryDetails->data,
            'storageAvailability' => $storageAvailability->data,
            'pageHeading' => 'Category Tricks'
        ]; 
        
        return view('templates/header_with_avalable_size_info',$data)
              .view('templates/left_menu',$data)
              .view('categorytricks/CategoryTricksView',$data)            
              .view('templates/footer',$data);
    } 
    function convertDirectlinkToOpenable($link,$filename){
        $pdfContent = file_get_contents($link);
        // Get the file content using cURL (more reliable than file_get_contents)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $this->response
        ->setHeader('Content-Type', 'application/pdf')
        ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
        ->setBody($data);
    }
    public function TricksDetails()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        $dropboxClient = new \App\Libraries\DropboxClient();
        $category = '';
        if(null !=$this->request->uri->getSegment(3)){
            $category = $this->request->uri->getSegment(2);
            $trickId = $this->request->uri->getSegment(3);
        }else{
            $trickId = $this->request->uri->getSegment(2);
        }


        /////////Get User Storage Availability///////////
        $apidata = array(
            "user_id" => $_SESSION['employee_id']
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutUserStorageAvailability',$apidata);
        $storageAvailability = json_decode($result);
        //////////Category Details/////////////
        $apidata = array(
            "category" => $category
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetCategoryById',$apidata);
        $categoryDetails = json_decode($result);
        //////////Trick Category Name/////////////
        $apidata = array(
            "trick_id" => $trickId
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetTrickCategorysName',$apidata);
        $trickCategoryName = json_decode($result);
        //echo "<pre>";print_r($trickCategoryName);exit;


        ////////////Get trick details//////////////
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
            "trick_id" => $trickId
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutGetCategoryForTrickById',$apidata);
        $trickCategoryList = json_decode($result);
       // echo "<pre>";print_r($trickCategoryList);exit;
        $defaultTrickIcon = "";
        if(!count($categoryDetails->data)){
            foreach($trickCategoryList->data AS $singleCategory){
                if($singleCategory->mapping_id){
                    $defaultTrickIcon = $singleCategory->trick_default_icon;
                }
            }
        }


        $apidata = array(
            "type" => "trick",
            "typeId" => $trickId
        ); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutgetDocumentListByTypeAndTypeId',$apidata);
        $trickFileList = json_decode($result);
        //echo "<pre>";print_r($trickFileList);exit;
        $pdf_flag = 0;
        $video_flag = 0;
        $trickFilesArray = array();
        foreach($trickFileList->data AS $trickFile){
            //echo "<pre>";print_r($trickFileList);exit;
            $directLink = $dropboxClient->getDirectLink($trickFile->file_name);
            $trickFile->directLink =$directLink;
            array_push($trickFilesArray,$trickFile);
            if($trickFile->media_type=="pdf"){
                $pdf_flag = 1;
                //$pdf_link=$this->convertDirectlinkToOpenable($trickFile->directLink,$trickFile->file_name);
            }
            if($trickFile->media_type=="mp4"){
                $video_flag = 1;
            }
            /*if($trickFile->media_type=='mp4' || $trickFile->media_type=='webm' || $trickFile->media_type=='avi' || $trickFile->media_type=='mov' || $trickFile->media_type=='mkv'){
                $vedioFileArray = array();
                $directLink = $dropboxClient->getDirectLink($trickFile->file_name);
                $vedioFileArray['fileName'] = $trickFile->file_name;
                $vedioFileArray['directLink'] = $directLink;
                array_push($vedioFilesArray,$vedioFileArray);
                //echo "Link : ".$trickFile->file_name." : ".$directLink;exit;
            }*/
        }

        $data = [
            'title'   => 'TRICK DETAILS: '.PAGETITLE,
            'documentType' => 'trick',
            'trickDetails' => $trickDetails->data,
            'trickFilesArray' => $trickFilesArray,
            'supplierList' => $supplierList->data,
            'trickCategoryList' => $trickCategoryList->data,
            'trickFileList' => $trickFileList->data,
            'storageAvailability' => $storageAvailability->data,
            'categoryDetails' => $categoryDetails->data,
            'trickCategoryName' => $trickCategoryName->data[0]->categories,
            'defaultTrickIcon' => $defaultTrickIcon,
            'pdf_flag' => $pdf_flag,
            'video_flag' => $video_flag,
            'pageHeading' => 'TRICK DETAILS'
        ]; 
        //echo "<pre>";print_r($trickFilesArray);exit;
        return view('templates/header_with_avalable_size_info',$data) 
                .view('templates/left_menu',$data)                           
              .view('tricksdetails/TricksDetailsView',$data)     
              .view('documentupload/documentUploadJSFunction',$data)
              .view('documentupload/documentUploadModalHtml',$data)        
              .view('templates/footer',$data); 
    }
    public function getTrickDetails(){
        $trick_id    = $this->request->getPost('trick_id');
        $apidata = array(
            "userId" => $_SESSION['employee_id'],
            "trickId" => $trick_id
        ); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutGetTrickDetailsById',$apidata);
        $trickDetails = json_decode($result);
        return $result;
    } 
    public function saveVideoNote()
    {
        $userId  = $_SESSION['employee_id'];
        $videoId = (int) ($this->request->getPost('video_id') ?? 0);
        $note    = $this->request->getPost('note');
        $noteId  = $this->request->getPost('note_id');
        $video_type  = $this->request->getPost('video_type');
        if (!$userId || !$videoId) {
            return $this->response->setStatusCode(400);
        }
        // return $this->response->setJSON([
        //     'status' => 'success',
        //     'note_id' => 5
        // ]);
        if ($noteId) {
        // UPDATE

            $data_file = array(
                "note" => $note
            );
            $update_data = array(
                "id_field_name" => "id",
                "id_field_value" => $noteId,
                "table_name" => "trick_video_notes",
                "updateData" => $data_file
            );
            $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);


        } else {
            // INSERT
            $insertDataArray = array();
            $insertData = array(
                "user_id" => $userId,
                "video_id" => $videoId,
                "note" => $note,
                "video_type" => $video_type 
            );
            array_push($insertDataArray,$insertData);   
            $apidata = array(
                "table_name" => "trick_video_notes",
                "insertDataArray" => $insertDataArray,
            );
            $insert_res = $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata);
            $insert_data = json_decode($insert_res);  
            $noteId = $insert_data->data->insertId;
        }
        return $this->response->setJSON([
            'status' => 'success',
            'note_id' => $noteId
        ]);
       // return $this->response->setJSON(['status' => 'success']);
    }

    public function getVideoNote(){
        $video_id    = $this->request->getPost('video_id');
        $video_type  = $this->request->getPost('video_type');
        $apidata = array(
            "video_id" => $video_id,
            "video_type" => $video_type
        ); 

        $result=$this->curl->curl_call(APIURL.'TrickedOutGetVideoNoteByVideoId',$apidata);
        $noteDetails = json_decode($result);  
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $noteDetails->data
        ]);     
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
               // echo "<pre>";print_r($_POST);exit;
                $data_file = array(
                    "name" => $_POST['name'],
                    "artist" => $_POST['artist'],
                    //"category" => $_POST['catagory'],
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


                        /////////Multiple category//////////////////
                        $apidata = array(
                            "trick_id" => $_POST['trick_id']
                        ); 
                        $result=$this->curl->curl_call(APIURL.'TrickedOutDeleteCategoryFromTrickById',$apidata);
                        $deleteResult = json_decode($result);
                        //echo "<pre>";print_r($deleteResult);exit;
                        $catagory =  $_POST['catagory'];
                        $insertCategoryArray = array();
                        foreach($catagory AS $oneCategory){
                            $insertCategory = array(
                                "trick_id" => $_POST['trick_id'],
                                "category_id" => $oneCategory,
                                "added_by" => $_SESSION['employee_id']
                            );
                            array_push($insertCategoryArray,$insertCategory);
                        }
                        if(count($insertCategoryArray)){
                            $apidata = array(
                                "table_name" => "trick_category_mapping",
                                "insertDataArray" => $insertCategoryArray,
                            );
                            $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata); 
                        } 
                        ////////////////////////////////////

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

    public function get_master_desc()
    {   
        try {            
            $param = array(
             "source_id" => $_POST['source_id']
            );   
            $res=$this->curl->curl_call(APIURL.'TrickedOutGetMasterDetailsById',$param);
             echo $res; 
            
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
    public function uploadFileBySplit()
    {
        // Directory where file chunks will be stored temporarily
        $uploadDir = 'trick_files/';
        $filename = $_POST['filename']; // Original filename
        $currentChunk = $_POST['currentChunk']; // Current chunk index
        $totalChunks = $_POST['totalChunks']; // Total number of chunks

        // Make sure the upload directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Temporary filename for each chunk
        $tempFile = $uploadDir . $filename . '.part' . $currentChunk;

        // Move the uploaded chunk to the temporary directory
        if (isset($_FILES['chunk']) && move_uploaded_file($_FILES['chunk']['tmp_name'], $tempFile)) {
            // Check if this is the last chunk
            if ($currentChunk + 1 == $totalChunks) {
                // Merge all chunks into the final file
                $timestamp = time();
                $newFilename = $timestamp."_".$filename;
                $finalFile = $uploadDir . $newFilename;
                $out = fopen($finalFile, 'wb');
                
                // Append all chunks to the final file
                for ($i = 0; $i < $totalChunks; $i++) {
                    $chunkFile = $uploadDir . $filename . '.part' . $i;
                    $in = fopen($chunkFile, 'rb');
                    stream_copy_to_stream($in, $out);
                    fclose($in);
                    unlink($chunkFile); // Remove the chunk after merging
                }
                fclose($out);

                // Return success response
                return json_encode(['success' => true, 'message' => 'Upload complete.', 'fileName' => $newFilename]);
            } else {
                // Return success response for chunk upload
                return json_encode(['success' => true, 'message' => 'Chunk uploaded.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload chunk.']);
        }
    }
    public function uploadMultipleFileBySplitTemp()
    {
        // Directory where file chunks will be stored temporarily
        $uploadDir = 'trick_upload_file/';
        $filename = $_POST['filename']; // Original filename
        $currentChunk = $_POST['currentChunk']; // Current chunk index
        $totalChunks = $_POST['totalChunks']; // Total number of chunks
        $session_id =$_POST['session_id'];
        // Make sure the upload directory exists
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Temporary filename for each chunk
        $tempFile = $uploadDir . $filename . '.part' . $currentChunk;

        // Move the uploaded chunk to the temporary directory
        if (isset($_FILES['chunk']) && move_uploaded_file($_FILES['chunk']['tmp_name'], $tempFile)) {
            // Check if this is the last chunk
            if ($currentChunk + 1 == $totalChunks) {
                // Merge all chunks into the final file
                $timestamp = time();
                $newFilename = $filename;
                $finalFile = $uploadDir . $newFilename;
                $out = fopen($finalFile, 'wb');
                
                // Append all chunks to the final file
                for ($i = 0; $i < $totalChunks; $i++) {
                    $chunkFile = $uploadDir . $filename . '.part' . $i;
                    $in = fopen($chunkFile, 'rb');
                    stream_copy_to_stream($in, $out);
                    fclose($in);
                    unlink($chunkFile); // Remove the chunk after merging
                }
                fclose($out);

                // Return success response
                return json_encode(['success' => true, 'message' => 'Upload complete.', 'fileName' => $newFilename]);
            } else {
                // Return success response for chunk upload
                return json_encode(['success' => true, 'message' => 'Chunk uploaded.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload chunk.']);
        }
    }
     public function insertLogAPI(){
        $log_type = $_POST['log_type'];
        $log_title = $_POST['log_title'];
        $log_details = $_POST['log_details'];
        $log_type_id = $_POST['log_type_id'];
        $this->insertActivateLog($log_type_id,$log_type,$log_details,$log_title);
    } 
    public function saveVideoProgress(){
        $video_id = $_POST['video_id'];
        $current_time = $_POST['current_time'];
        $duration = $_POST['duration'];
        $data_file = array(
            "current_time" => $current_time
            
        );
        $update_data = array(
            "id_field_name" => "id",
            "id_field_value" => $video_id,
            "table_name" => "document",
            "updateData" => $data_file
        );
        $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);

        //$log_type_id = $_POST['log_type_id'];        
    }  
    public function saveBackStageVideoProgress(){
        $video_id = $_POST['video_id'];
        $current_time = $_POST['current_time'];
        //$duration = $_POST['duration'];
        $data_file = array(
            "current_time" => $current_time
        );
        $update_data = array(
            "id_field_name" => "id",
            "id_field_value" => $video_id,
            "table_name" => "temp_master_data",
            "updateData" => $data_file
        );
        $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);        
    }
}
