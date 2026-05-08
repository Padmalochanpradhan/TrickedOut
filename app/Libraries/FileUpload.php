<?php

namespace App\Libraries;
use App\Libraries\Mycurl;

class FileUpload
{ 

// Upload for single file   
    public function singleUpload($title,$note,$type,$type_id,$file){
        $this->curl = new Mycurl();
 
        if($file){

            $fileTmpPath = $file['tmp_name'];
            $fileName = $file['name'];
            //$fileSize = $file['size'];
            //$fileType = $file['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));  
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  
            if (!file_exists(FOLDER_UPLOAD.date('Ymd'))) {
                mkdir(FOLDER_UPLOAD.date('Ymd'), 0777, true);
            }
            $uploadFileDir = FOLDER_UPLOAD.date('Ymd').'/';
            $dest_path = $uploadFileDir . $newFileName;

            if(move_uploaded_file($fileTmpPath, $dest_path))
            {
              $insertData = array(                 
                    "title" => $title,
                    "note" => $note,
                    "type" => $type,                
                    "type_id" => $type_id,                  
                    "attachment" => date('Ymd').'/'.$newFileName,
                    "added_date" => date('Y-m-d H:i:s'),
                    "added_by" => $_SESSION['userId']                 
                );

                $insert = array(
                    "insertData" => $insertData,
                    "table_name" => TABLE_DOCUMENT
                );
                $this->curl->curl_call(APIURL.API_INSERT_DATA,$insert); 
            
                 return   UPLOAD_SUCESS_MSG ; 
            }                      
            
         }else{
            return UPLOAD_ERROR_MSG;
         }        
    }

    // Upload for multiple file   
    public function multipleUpload($title,$note,$type,$type_id,$files){
        $this->curl = new Mycurl();

        if($files){ 
             //echo "<pre>";print_r($files);
             for ($i=0; $i < count($files['tmp_name']) ; $i++) { 
                  
                $fileTmpPath =  $files['tmp_name'][$i]; 
                $fileName = $files['name'][$i]; 
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));  
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  
                if (!file_exists(FOLDER_UPLOAD.date('Ymd'))) {
                    mkdir(FOLDER_UPLOAD.date('Ymd'), 0777, true);
                }
                $uploadFileDir = FOLDER_UPLOAD.date('Ymd').'/';
                $dest_path = $uploadFileDir . $newFileName;
                 if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                    $insertData = array(                 
                        "title" => $title,
                        "note" => $note,
                        "type" => $type,                
                        "type_id" => $type_id,                  
                        "file" => date('Ymd').'/'.$newFileName,
                        "added_date" => date('Y-m-d H:i:s'),
                        "added_by" => $_SESSION['userId']                 
                    );
                    $insert = array(
                        "insertData" => $insertData,
                        "table_name" =>TABLE_DOCUMENT
                    );
                    $this->curl->curl_call(APIURL.API_INSERT_DATA,$insert);
                }
             } 
             return UPLOAD_SUCESS_MSG;   
         }else{
            return UPLOAD_ERROR_MSG;
         }        
    } 
    // Upload for multiple file   
    public function MultipleUploadFileTitle($title,$note,$type,$type_id,$files){
        $this->curl = new Mycurl();

        if($files){ 
           //  echo "<pre>";print_r($files);
            $insertDataArray = array();
             for ($i=0; $i < count($files['tmp_name']) ; $i++) { 
                  
                $fileTmpPath =  $files['tmp_name'][$i]; 
                $fileName = $files['name'][$i]; 
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));  
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  
                // if (!file_exists(FOLDER_UPLOAD.date('Ymd'))) {
                //     mkdir(FOLDER_UPLOAD.date('Ymd'), 0777, true);
                // }
                $uploadFileDir = FOLDER_UPLOAD;
                $dest_path = $uploadFileDir . $newFileName;
                $singleTitle = '';

                $fileError = $files['error'][$i];  // File error code
                if ($fileError !== UPLOAD_ERR_OK) {
                    //return $fileError;
                    switch ($fileError) {
                        case UPLOAD_ERR_INI_SIZE:
                            return "Error: The file exceeds the upload_max_filesize directive in php.ini.";
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            return "Error: The file exceeds the MAX_FILE_SIZE directive specified in the HTML form.";
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            return "Error: The file was only partially uploaded.";
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            return "Error: No file was uploaded.";
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                            return "Error: Missing a temporary folder.";
                            break;
                        case UPLOAD_ERR_CANT_WRITE:
                            return "Error: Failed to write file to disk.";
                            break;
                        case UPLOAD_ERR_EXTENSION:
                            return "Error: A PHP extension stopped the file upload.";
                            break;
                        default:
                            return "Error: Unknown error occurred.";
                            break;
                    }
                    continue;  // Skip further processing for this file

                }
                //echo   $singleTitle;
                 if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                    $insertData = array(                 
                        "type" => $type,                
                        "type_id" => $type_id,                  
                        "file_name" => $newFileName,
                        "media_type" => $fileExtension,
                        "added_by" => $_SESSION['employee_id']
                    );
                   //print_r($insertData);
                    array_push($insertDataArray,$insertData);
                 //echo "<pre>";print_r($result1);exit;
                 //   exit;
                } else {
                    // Get the last error
                    $error = error_get_last();
                    return "File upload failed $fileName. Error: " . $error;
                }
             } 
            if(count($insertDataArray)){
                $insert = array(
                    "insertDataArray" => $insertDataArray,
                    "table_name" => TABLE_DOCUMENT
                );
               $return=$this->curl->curl_call(APIURL.API_INSERT_MULTIPLE_DATA,$insert);
               //return APIURL.API_INSERT_DATA;
            }
             return UPLOAD_SUCESS_MSG;   
         }else{
            return UPLOAD_ERROR_MSG;
         }        
    } 


    // Upload for multiple file   
    public function MultipleAttachment($type,$added_by,$files){
        // $this->curl = new Mycurl();

        // if($type == 1){
        //     $part = 'FUEL/';
        // }else if($type == 2){
        //     $part = 'MAINTENANCE/';
        // }else if($type == 3){
        //     $part = 'PHOTO/';
        // }
 
         //if(isset($files)){ 
        //      //echo $type.'===='.$added_by;
        //      //echo "<pre>";print_r($_FILES['files']);exit;


             for ($i=0; $i < count($files['tmp_name']) ; $i++) { 
                  
                $fileTmpPath =  $files['tmp_name'][$i]; 
                $fileName = $files['name'][$i]; 
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));  
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;  

                if (!file_exists(ATTACHMENT_FOLDER.$part.date('Ymd'))) {
                    mkdir(ATTACHMENT_FOLDER.$part.date('Ymd'), 0777, true);
                }
                $uploadFileDir = ATTACHMENT_FOLDER.$part.date('Ymd').'/';

                $dest_path = $uploadFileDir . $newFileName;
                //$singleTitle = $title[$i];
                //echo   $singleTitle;
                 if(move_uploaded_file($fileTmpPath, $dest_path))
                {
                    $insertData = array(                 
                        //"title" => $singleTitle,
                        //"note" => $note,
                        "type_id" => $type,                
                        //"type_id" => $type_id,                  
                        "attachment" => $part.date('Ymd').'/'.$newFileName,
                        //"added_date" => date('Y-m-d H:i:s'),
                        "added_by" => $added_by                 
                    );
                    
                    $insert = array(
                        "insertData" => $insertData,
                        "table_name" => 'all_attachment'
                    );
                   $this->curl->curl_call(APIURL.API_INSERT_DATA,$insert);
                    //echo "<pre>";print_r($result1);exit;
                    //exit;
                }
             } 
        //      return 1;   
        //  }else{
        //     return 0;
          //}  
         return 1;      
    } 

    
}