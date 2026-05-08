<?php

namespace App\Controllers;

class MyVaultController extends BaseController
{ 

    public function MyVault()
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
                "userId" => $_SESSION['employee_id'],
                "multipleCategoryFlag" => 1
            ); 

            $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksList',$apidata);
            $trickList = json_decode($result);
            //echo "<pre>";print_r($trickList);exit;
            $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksCategory',$apidata);
            $trickCategoryList = json_decode($result);
            //echo "<pre>";print_r($trickCategoryList);exit;
            ////////////To get backstage count//////////////
            $apidata = array(
                "userId" => $_SESSION['employee_id']
            ); 
            $result=$this->curl->curl_call(APIURL.'TrickedOutGetBackstageListByUser',$apidata);
            $backstageList = json_decode($result);
            //echo "<pre>";print_r($backstageList);exit;
            $backstageCount = count($backstageList->data);
            /////////////////////////////////////////////////
            
        //echo "<pre>";print_r($trickCategoryList->data);exit;
        $actionList = array();
        $tricks = $trickList->data;
        foreach ($tricks as $key => $trick) {
            $tricks[$key]->short_description = $this->truncateHtml($trick->description, 30);
            $tricks[$key]->short_video_note = $this->truncateHtml($trick->trick_video_note, 30);
        }
        $data = [
            'title'   => 'MY VAULT :: '.PAGETITLE,
            'fromdate' => $from,
            'todate' => $to,
            'backstageCount' => $backstageCount,
            'trickList' => $tricks,
            'trickCategoryList' => $trickCategoryList->data,
            'storageAvailability' => $storageAvailability->data,
            'pageHeading' => 'MY VAULT'
        ]; 
        
        return view('templates/header_with_avalable_size_info',$data)
              .view('templates/left_menu',$data)
              .view('myvault/MyVaultView',$data)
              .view('templates/footer',$data);
    } 
function truncateHtml($html, $length = 45, $ending = '...') {
    $totalLength = 0;
    $openTags = [];
    $truncated = '';

    // Match HTML tags or plain text
    preg_match_all('/(<[^>]+>|[^<]+)/', $html, $matches);

    foreach ($matches[0] as $part) {
        if ($part[0] === '<') { 
            // It's a tag
            if (preg_match('/<(\w+)[^>]*>/', $part, $tagMatch)) {
                $openTags[] = $tagMatch[1];
            } elseif (preg_match('/<\/(\w+)>/', $part, $tagMatch)) {
                $key = array_search($tagMatch[1], $openTags);
                if ($key !== false) unset($openTags[$key]);
            }
            $truncated .= $part;
        } else { 
            // It's text
            $partLength = mb_strlen($part);
            if ($totalLength + $partLength > $length) {
                $truncated .= mb_substr($part, 0, $length - $totalLength) . $ending;
                break;
            } else {
                $truncated .= $part;
                $totalLength += $partLength;
            }
        }
    }

    // Close any open tags
    foreach (array_reverse($openTags) as $tag) {
        $truncated .= "</$tag>";
    }

    return $truncated;
}        
}
