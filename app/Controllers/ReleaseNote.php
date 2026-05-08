<?php

namespace App\Controllers;

class ReleaseNote extends BaseController
{ 

    public function note()
    {
        //echo $this->request->uri->getSegment(2);exit;
        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }

            $apidata = array(
                "user_id" => $_SESSION['employee_id']
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutUserStorageAvailability',$apidata);
            $storageAvailability = json_decode($result);
        
        $result=$this->curl->curl_call(APIURL.'trickedoutreleasenote','');
        $releasenote = json_decode($result); 
        //echo "<pre>";print_r($releasenote->data);exit;

        $actionList = array();

        $data = [
            'title'   => 'RELEASE NOTE :: '.PAGETITLE, 
            'releasenote' => $releasenote->data, 
            'storageAvailability' => $storageAvailability->data, 
            'pageHeading' => 'RELEASE NOTE'
        ]; 
        
        return view('templates/header_with_avalable_size_info',$data)
              .view('templates/left_menu',$data)
              .view('releaseNote/releaseNoteView',$data)               
              .view('templates/footer',$data);
    } 

    public function note_update(){
        //echo "<pre>"; print_r($_POST);exit;
        if($_POST['releasenote_id']){
            if(isset($_POST['releasenote_description'])){
                $data_file = array(
                    "note" => $_POST['releasenote_description']
                );
                $update_data = array(
                    "id_field_name" => "id",
                    "id_field_value" => $_POST['releasenote_id'],
                    "table_name" => "releaseNote",
                    "updateData" => $data_file
                );
                $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
            }           
              
        }else{
             $result=$this->curl->curl_call(APIURL.'trickedoutgetmaxreleasenote','');
             $releasenote = json_decode($result);
             $max_version = (($releasenote->data[0]->max_version)+1);
            //echo "<pre>"; print_r($releasenote->data[0]->max_version);exit;
             $insertDataArray = array();

            $insertData = array(                 
                "title" => "Version 10092.".$max_version,
                "note" => $_POST['releasenote_description'],
                "version" => $max_version,        
                "addeddate" => date('Y-m-d H:i:s')      
            );
            array_push($insertDataArray,$insertData);
                    
            $insert = array(
                "insertDataArray" => $insertDataArray,
                "table_name" => 'releaseNote'
            );
            
           $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert);
           //echo "<pre>"; print_r($result);exit;

        }
        return redirect()->to(base_url('note')); exit;
    }
     

}
