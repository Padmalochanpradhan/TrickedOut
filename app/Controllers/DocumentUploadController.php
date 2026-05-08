<?php
namespace App\Controllers;
// use CodeIgniter\RESTful\ResourceController;
// use CodeIgniter\API\ResponseTrait;
// header("Access-Control-Allow-Origin: *");
// use App\Libraries\FileUpload;
// use App\Libraries\Mycurl;

//use CodeIgniter\API\ResponseTrait;
class DocumentUploadController extends BaseController
{  

/* 
    Common control for document upload.
    Single and multiple document can be upload using this function
*/   
    //use ResponseTrait;
    public function DocumentUpload()
    {    
        // if(!$this->session->get('loggedIn')) {
        //    return redirect()->to(base_url('login')); exit;     
        // }  

        $data_reponse = array();
        $data_reponse['token'] = csrf_hash();
        $data_reponse['status_code'] = 200;
        //return $_FILES;
        if(count($_FILES)!=0)
        {
         if($_FILES['files']['tmp_name']){
            $type = $this->request->getVar('document_type');
            $titleArray = '';
            $note =  "";
            $typeId = $this->request->getVar('module_element_id');
           $result=$this->upload->multipleUploadFileTitle($titleArray,$note,$type,$typeId,$_FILES['files']);
        }  
        $data_reponse['result'] = $result;
            //return $data_reponse;
      //  $this->session->setFlashdata("sucessMessage", UPLOAD_SUCESS_MSG);   
         return $this->response->setJSON($data_reponse); 
        }   
       
    }
// Function for insert in document table after uploaded
    public function insertUploadedFilesInTable(){
            $type = $this->request->getVar('document_type');
            $typeId = $this->request->getVar('module_element_id');
            //$uploadedFiles = $this->request->getVar('uploadedFiles');
            //loop for each uploaded file
            $fileArray = json_decode($_POST['uploadedFiles1'], true);
            $fileSizeArray = json_decode($_POST['uploadedFileSize'], true);
            $insertDataArray = array();
            $i=0;
            foreach($fileArray AS $oneFileName){
                $fileNameCmps = explode(".", $oneFileName);
                $fileExtension = strtolower(end($fileNameCmps));
                    $insertData = array(
                        "type" => $type,
                        "type_id" => $typeId,
                        "file_name" => $oneFileName,
                        "file_size" => $fileSizeArray[$i],
                        "added_by" => $_SESSION['employee_id'],
                        "media_type" => $fileExtension
                    );
                    array_push($insertDataArray,$insertData);
                    $i++;
            }

            if(count($insertDataArray)){
                $apidata = array(
                    "table_name" => "document",
                    "insertDataArray" => $insertDataArray,
                );
               $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata); 
            }
return json_encode(['success' => true, 'message' => 'File uploaded.']);

    }
 
    // FUNCTION FOR ALL ATTACHMENT START

    public function AllAttachment()
    {    
      $this->curl = new Mycurl();
        // if(!$this->session->get('loggedIn')) {
        //    return redirect()->to(base_url('login')); exit;     
        // } 
        // echo "<pre>";print_r($_FILES['files']);
         // echo "<pre>1234";print_r($_POST);
         // exit;
        $data_reponse = array();
        $data_reponse['token'] = csrf_hash();;
        $data_reponse['status_code'] = 400;
        //$data_reponse['token_count'] = 2;
        //$data_reponse['token_count'] = count($_FILES);
        //return $this->response->setJSON($data_reponse);
        ////////////////////////////////////////////////////////////
                $type = $this->request->getVar('type'); 
                $added_by = $this->request->getVar('added_by');
                if($type == 1){
            $part = 'FUEL/';
        }else if($type == 2){
            $part = 'MAINTENANCE/';
        }else if($type == 3){
            $part = 'PHOTO/';
        } 
           // if(count($_FILES)!=0)
           // {
           //   $data_reponse['token_count1'] = count($_FILES['files']);
           //   if($_FILES['files']['tmp_name']){
           //    $data_reponse['token_count1'] = count($_FILES);
           //      $type = $this->request->getVar('type'); 
           //      $added_by = $this->request->getVar('added_by');
           //      //$result=$this->upload->MultipleAttachment($type,$added_by,$_FILES['files']);
        $files=$_FILES['files'];
        $data_reponse['token_count'] = count($files);
            // for ($i=0; $i < count($files) ; $i++) { 
              if($files['tmp_name']){
                 $fileTmpPath =  $files['tmp_name']; 
                $fileName = $files['name']; 
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
               // $data_reponse['token_count1'] = 12;
               // $data_reponse['token'] = $dest_path;
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
                  $data_reponse['status_code'] = 200;

                   $data_reponse['message'] = "Uploaded Successfully.";
                 }else{
                   $data_reponse['message'] = "Upload Failed 111.";

                 }
               }
            // }
////////////////////////////////////////////
             if(!count($files)){
                   $data_reponse['message'] = "Upload Failed 222.";
             }
//$data_reponse['message'] = $_FILES['files']['tmp_name'];
           //   } 
           // }   
            return $this->response->setJSON($data_reponse); 
       
    }
}
