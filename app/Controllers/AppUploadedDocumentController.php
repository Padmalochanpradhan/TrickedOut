<?php
/**
*  @category   User Manage
 * @package    Controllers
 * @author     Prajna
 * @copyright  2022 Karma
*/
namespace App\Controllers;

class AppUploadedDocumentController extends BaseController
{ 
    /**
     *  Created Date:02nd Feb 2024
     *  Created By:Padma
      
     */
    public function DocumentManage()
    {            
         if(!$this->session->get('loggedIn')) {
             return redirect()->to(base_url('login')); exit;     
         }          
        if(!isset($_SESSION['function_security'][MANAGE_USER_CODE])){
            $data = [                
                'title'   => PAGETITLE,
                'pageheading' => PAGE_TITLE_APP_UPLOAD
            ];
            return view('templates/leftmenu',$data)
                  .view('templates/AccessDeniedView',$data)
                  .view('templates/footer',$data);
        } 
     
     //Get role list
         $parameter = array(                 
            "company_id" => $_SESSION['companyId'] ,
            "status_id" => "0"     
        );   
     
        $resultrole=$this->curl->curl_call(APIURL.API_USER_ROLE_LIST,$parameter);
        $roleList = json_decode($resultrole);
            
          //Get  company list
              $parameter = array(                 
                "status_id" => "0"     
            ); 
            $result=$this->curl->curl_call(APIURL.API_COMPANY_ALL_LIST, $parameter);
            $companyList = json_decode($result);

            
            $apiParameters = array(
                "module" => MODULE_USER
            ); 
            $actionListResult=$this->curl->curl_call(APIURL.API_GET_ACTION_DROPDOWN_DETAILS_BY_MODULE,$apiParameters);
            $actionList = json_decode($actionListResult);    
            //echo "<pre>";print_r($roleList);exit;
            $result = $this->curl->curl_call(APIURL . API_APP_UPLOADED_DOCUMENT_LIST, ''); 
           
            $documentList = json_decode($result);
             $result = $this->curl->curl_call(APIURL . 'DSPGetAppUploadedStatusList', ''); 
            $statusList = json_decode($result);
           //echo "<pre>";print_r($statusList);exit;
        
        $data = [
            'title'   => PAGE_TITLE_APP_UPLOAD.' :: '.PAGETITLE,
            'pageHeading' => PAGE_TITLE_APP_UPLOAD ,   
            'roleList' => $roleList->data,
            'companyList' => $companyList->data,
            'actionList' => $actionList->data,
            'statusList' => $statusList->data,
            'documentList' => $documentList->data
        ]; 
        return view('templates/leftmenu',$data)
              .view('appUploadedDocument/appUploadedDocumentView',$data)
              .view('appUploadedDocument/appUploadedDocumentJS',$data)
              .view('templates/CommonJSFunction',$data)
              .view('templates/footer',$data);
    } 

    public function appUploadDocumentlist()
    {
        //get  vehicle  list data company wise for admin and get all data for super admin
        try {
           // if($_SESSION['roleName']=="Administrator")
           //  {
           //      $parameter = array(
           //          "compId" => $_SESSION['companyId'],
           //        );   
           //      $result = $this->curl->curl_call(APIURL . API_USER_LIST, $parameter);
           //  }
           //  else
           //  {
           //      $result = $this->curl->curl_call(APIURL . API_USER_LIST, ''); 
           //  }
            $result = $this->curl->curl_call(APIURL . API_APP_UPLOADED_DOCUMENT_LIST, ''); 
           
            $userList = json_decode($result);
            //echo "<pre>";print_r($userList);exit;
            $dataTableUsereData['recordsTotal'] = count($userList->data);
            $dataTableUsereData['recordsFiltered'] = count($userList->data);
            $dataTableUsereData['data'] = $userList->data;
            echo json_encode($dataTableUsereData);
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    } 
   
}
