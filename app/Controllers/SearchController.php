<?php

namespace App\Controllers;

class SearchController extends BaseController
{ 

    public function Search()
    {

        if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
        }
        if(isset($_POST['search_input']) AND $_POST['search_input']!=""){
            $filterArray = array(
                "tri.name" => $_POST['search_input'],
                "tri.description" => $_POST['search_input'],
                "tc.category_name" => $_POST['search_input'],
                "s.name" => $_POST['search_input']
            );
            $apidata = array(
                "userId" => $_SESSION['employee_id'],
                "filterArray" => $filterArray
            ); 
            $result=$this->curl->curl_call(APIURL.'TrickedOutGetUserTricksList',$apidata);
            $trickList = json_decode($result);
            //echo "<pre>";print_r($trickList);exit;
            $searchTrickList = $trickList->data;
            $search_input = $_POST['search_input'];
        }else{
            $searchTrickList = array();
            $search_input = "";
        }
            $data = [
                'title'   => 'SEARCH :: '.PAGETITLE,
                'trickList' => $searchTrickList,
                'search_input' => $search_input,
                'pageHeading' => 'MY VAULT'
            ]; 

     return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('search/SearchView',$data)
              .view('templates/footer',$data);
    } 
        
}
