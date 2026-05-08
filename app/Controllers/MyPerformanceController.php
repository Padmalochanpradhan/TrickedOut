<?php

namespace App\Controllers;

use App\Libraries\DropboxClient;

class MyPerformanceController extends BaseController
{ 

    public function MyPerformance()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }


            $apidata = array(
                "user_id" => $_SESSION['employee_id']
            ); 

            // $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksList',$apidata);
            // $trickList = json_decode($result);
            $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserPerformanceList',$apidata);
            $trickPerformanceList = json_decode($result);

            
        //echo "<pre>";print_r($trickPerformanceList->data);exit;
        $actionList = array();

        $data = [
            'title'   => 'MY PERFORMANCE :: '.PAGETITLE,
            // 'fromdate' => $from,
            // 'todate' => $to,
            //'trickList' => $trickList->data,
            'performanceList' => $trickPerformanceList->data,
            'pageHeading' => 'MY PERFORMANCE'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('myperformance/MyPerformanceView',$data)
              .view('templates/footer',$data);
    } 
    public function MyPerformanceAdd()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
            $performanceDetails = null;
            $performanceId = $this->request->uri->getSegment(2);
            $actionStr = "Add";
            $actionStrCap = "ADD";
            if($performanceId){
                $apidata = array(
                    "performanceId" => $performanceId
                ); 
                $result=$this->curl->curl_call(APIURL.'TrickedOutGetPerformanceDetails',$apidata);
                $resultData = json_decode($result);
                //echo "<pre>";print_r($resultData);exit;
                // Assign only if data exists
                if (!empty($resultData->data) && isset($resultData->data[0])) {
                    $performanceDetails = $resultData->data[0];
                        // Format contact phone if it's 10 digits
                    if (!empty($performanceDetails->contact_phone)) {
                        $rawPhone = preg_replace('/\D/', '', $performanceDetails->contact_phone); // Remove non-digits

                        if (strlen($rawPhone) == 10) {
                            $areaCode = substr($rawPhone, 0, 3);
                            $middle   = substr($rawPhone, 3, 3);
                            $last     = substr($rawPhone, 6, 4);
                            $performanceDetails->contact_phone = "($areaCode) $middle-$last";
                        } else {
                            $performanceDetails->contact_phone = $rawPhone; // Keep as is if not 10 digits
                        }
                    }
                    
                }
                $actionStr = "Update";
                $actionStrCap = "UPDATE";
                //echo "<pre>";print_r($performanceDetails);exit;
            }
           // $trickList = json_decode($result);
            // $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
            // $trickCategoryList = json_decode($result);

            
        
        $actionList = array();

        $data = [
            'title'   => 'MY PERFORMANCE '.$actionStrCap.':: '.PAGETITLE,
            // 'fromdate' => $from,
             'actionStr' => $actionStr,
            'performanceDetails' => $performanceDetails,
            //'trickCategoryList' => $trickCategoryList->data,
            'pageHeading' => 'MY PERFORMANCE '.$actionStrCap
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('myperformance/MyPerformanceAddView',$data)
              .view('templates/footer',$data);
    }
    public function PerformanceSubmit(){
        if($_POST){  
            if($_POST['performance_date']){
                $_POST['performance_date'] = date("Y-m-d", strtotime($_POST['performance_date']));
            }
            $performance_id =  $_POST['performance_id'];
            $name =  $_POST['name'];
            $description =  $_POST['description'];
            $description =  $_POST['description'];
            $performance_date =  $_POST['performance_date'];
            $location =  $_POST['location'];
            $contact_name =  $_POST['contact_name'];
            $contact_phone =  $_POST['contact_phone'];
            $contact_phone = preg_replace('/\D/', '', $contact_phone);
            $feedback =  $_POST['feedback'];
            $insertDataArray = array();
            if($performance_id){
                    $updateData = array(
                        "name" => $name,
                        "location" => $location,
                        "details" => $description,
                        "performance_date" => $performance_date,
                        "contact_name" => $contact_name,
                        "contact_phone" => $contact_phone,
                        "feedback" => $feedback
                    );
                    $update_data = array(
                        "id_field_name" => "id",
                        "id_field_value" => $performance_id,
                        "table_name" => "trick_performance",
                        "updateData" => $updateData
                    );
                    $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
                    //echo "<pre>";print_r($performanceReturn);exit;
                    $insertId=$performance_id; 
                    session()->setFlashdata('success', 'Performance updated successfully!');

            }else{
                $insertData = array(
                    "name" => $name,
                    "location" => $location,
                    "details" => $description,
                    "performance_date" => $performance_date,
                    "contact_name" => $contact_name,
                    "contact_phone" => $contact_phone,
                    "feedback" => $feedback,
                    "added_by" => $_SESSION['employee_id']
                );
                array_push($insertDataArray,$insertData);
                $insertId = 0;
                if(count($insertDataArray)){
                    $apidata = array(
                        "table_name" => "trick_performance",
                        "insertDataArray" => $insertDataArray,
                    );
                   $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata); 
                }
                $performanceReturn = json_decode($result);
                //echo "<pre>";print_r($performanceReturn);exit;
                $insertId=$performanceReturn->data->insertId; 
                session()->setFlashdata('success', 'Performance added successfully!');
            }           
            //$insertId = $result['data'].
            //////////////////////////////////////////////
            $performanceFile=$_FILES['performanceFile'];
            if($performanceFile && $insertId){
                $fileTmpPath = $performanceFile['tmp_name'];
                $fileName = $performanceFile['name'];
                //$fileSize = $file['size'];
                //$fileType = $file['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));  
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dropboxPath = '/performance_files/' . $newFileName;

                try {
                    $dropboxClient = new DropboxClient();
                    $dropboxClient->uploadLargeFile($fileTmpPath, $dropboxPath);

                    $data_file = array(
                        "performance_file" => $newFileName
                    );
                    $update_data = array(
                        "id_field_name" => "id",
                        "id_field_value" => $insertId,
                        "table_name" => "trick_performance",
                        "updateData" => $data_file
                    );
                    $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
                } catch (\Exception $e) {
                    log_message('error', 'Performance file Dropbox upload failed: ' . $e->getMessage());
                }
            } 
            
            return redirect()->to(base_url('MyPerformance')); exit;            
            //echo "<pre>";print_r($result);
        }
    } 
    public function getPerformanceFileUrl($filename)
    {
        if (!$this->session->get('loggedIn')) {
            return $this->response->setJSON(['error' => 'Unauthorized'])->setStatusCode(401);
        }
        $dropboxClient = new DropboxClient();
        $url = $dropboxClient->getPerformanceFileLink($filename);
        if (!$url) {
            return $this->response->setJSON(['error' => 'File not found'])->setStatusCode(404);
        }
        return $this->response->setJSON(['url' => $url]);
    }

    public function DeletePerformance()
    {
        $id = $_POST['id'];

        // Fetch filename before deleting the DB record
        $filename = null;
        $detail = json_decode($this->curl->curl_call(APIURL.'TrickedOutGetPerformanceDetails', ['performanceId' => $id]));
        if (!empty($detail->data[0]->performance_file)) {
            $filename = $detail->data[0]->performance_file;
        }

        // Delete from DB
        $result = $this->curl->curl_call(APIURL.'TrickedOutDeletePerformance', ['id' => $id]);

        // Delete from Dropbox
        if ($filename) {
            try {
                $dropboxClient = new DropboxClient();
                $dropboxClient->delete('/performance_files/' . $filename);
            } catch (\Exception $e) {
                log_message('error', 'Dropbox delete failed for performance file ' . $filename . ': ' . $e->getMessage());
            }
        }

        session()->setFlashdata('success', 'Performance deleted successfully!');
        return $result;
    } 
    public function savePerformanceVideoProgress(){
        $video_id = $_POST['video_id'];
        $current_time = $_POST['current_time'];

        $data_file = array(
            "current_time" => $current_time
        );
        $update_data = array(
            "id_field_name" => "id",
            "id_field_value" => $video_id,
            "table_name" => "trick_performance",
            "updateData" => $data_file
        );
        $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);      
    }  
}
