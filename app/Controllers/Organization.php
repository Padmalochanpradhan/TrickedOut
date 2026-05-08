<?php

namespace App\Controllers;
use App\Libraries\Mailer;
//use App\Libraries\Snssms;
use App\Services\TwilioService;
class Organization extends BaseController
{ 

    public function index()
    { 
        $org_code = $this->request->uri->getSegment(1); 
        if ($org_code) {
            $params = [
                "org_name" => $org_code 
            ];
            $result = $this->curl->curl_call(APIURL.'TrickedOutOrganizationById', $params);
            $organization = json_decode($result);
            //echo "<pre>";print_r($organization);
            // ✅ Check if valid response
            if (
                !$organization || 
                !isset($organization->data) || 
                empty($organization->data)
            ) {
                // ❌ Invalid org code
                return view('errors/custom_error', [
                    'message' => 'Invalid or expired URL.'
                ]);
            }
        } else {
            // ❌ No org_code in URL
            return view('errors/custom_error', [
                'message' => 'Invalid or expired URL.'
            ]);
        }
       // echo "<pre>";print_r($organization);exit;
        // ✅ Clear session
        unset($_SESSION['payment_display'], $_SESSION['valid_upto'], $_SESSION['org_memory']);
       $_SESSION['payment_display'] = $organization->data[0]->payment_flag;
        $_SESSION['valid_upto'] = $organization->data[0]->month; 
        $_SESSION['org_memory'] = $organization->data[0]->org_memory;        
        $data = [
            'title'   => 'Organization :: '.PAGETITLE, 
            'organization' => $organization->data[0], 
            'orgid' => $organization->data[0]->id, 
            'pageHeading' => 'Organization'
        ];         
        return view('organization/orgView', $data);
    }
     public function details()
    { 
        if($this->request->getMethod() == 'post'){
            if (!filter_var($this->request->getPost('userName'), FILTER_VALIDATE_EMAIL)) {
                return redirect()->back()->with('err_msg', 'Please enter a valid email address.');
            }             

             $email = $this->request->getVar('userName');
             $orgid = $this->request->getVar('orgid');
             $org_code = $this->request->getVar('org_code');
             $association = $this->request->getVar('association');

             $params1 = array(
                "fieldName" => 'email_id',
                "fieldValue" => $email
             );

            $result2 =$this->curl->curl_call(APIURL."TrickedOutFieldValueByFieldName",$params1);
            $user_exist = json_decode($result2);
            if (!empty($user_exist->data) && isset($user_exist->data[0]->employee_id)) {
                $this->session->setFlashdata('err_msg', 'The email ID is already registered, please login.');
                return redirect()->to(base_url('login'));exit;
            }
             
             $parameter = array(
                "email_id" => $email,
                "org_id" => $orgid
             );

             $tempVerify =$this->curl->curl_call(APIURL."TrickedOutVarifyAssociationMember",$parameter);
             $userExist = json_decode($tempVerify);
             //echo "<pre>";print_r($resultExist);exit;

             if($association == 1 && empty($userExist->data[0]->id)){ 
                $this->session->setFlashdata('err_msg', 'The email ID is not qualified for the offer.');
                return redirect()->to(base_url('organization/'.$org_code));exit; 
             } else if (!empty($userExist->data[0]->org_id) && $userExist->data[0]->org_id != $orgid) {
                 $this->session->setFlashdata('err_msg', 'The email ID is mapped with other association.');
                return redirect()->to(base_url('organization/'.$org_code));exit;
             } 
                         
        } 

        if($orgid) {
            $params = array(
                "id" => $orgid 
            );
            $result=$this->curl->curl_call(APIURL.'TrickedOutOrganizationById',$params);
            $organization = json_decode($result);       
        } 
        $userdata = (object)[
            'org_id' => '',
            'phone' => '',
            'email_id' => '',
            'firstname' => '',
            'lastname' => ''
        ];

        if(!empty($userExist->data)) {
            $userdata = $userExist->data[0];
        }

        // echo "<pre>";print_r($organization->data[0]);
        // echo "<pre>";print_r($userdata);exit;

        $_SESSION['payment_display'] = $organization->data[0]->payment_flag;
        $_SESSION['valid_upto'] = $organization->data[0]->month; 
        $_SESSION['org_memory'] = $organization->data[0]->org_memory;        

        $data = [
            'title'   => 'Organization :: '.PAGETITLE, 
            'organization' => $organization->data[0], 
            'userdetails' => $userdata, 
            'orgid' => $orgid, 
            'email' => $email, 
            'pageHeading' => 'Organization'
        ];         
        return view('organization/orgDetailsView', $data);
    }

    public function orgdetailssubmit()
    {  
        if($this->request->getMethod() == 'post'){
            //echo "<pre>";print_r($_POST);exit;

            $orgid = $this->request->getVar('orgid');
            $coupon = $this->request->getVar('coupon');
            $phone = $this->request->getVar('phone');
            $email_id = $this->request->getVar('userName');
            $first_name = $this->request->getVar('first_name');
            $last_name = $this->request->getVar('last_name');
            $password = $this->request->getVar('password');

            if($orgid){
                $insertDataArray = array();
                $insertData = array(
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "organization_id" => $orgid,
                    "phone" => $phone,
                    "type" => 'User',
                    "employee_role" => 'User',
                    "email_id" => $email_id,
                    "password" => $password,
                    "promotion_code_id" => $coupon,
                    "is_verified" => 1  
                );
                array_push($insertDataArray,$insertData);                    
                $apidata = array(
                  "insertDataArray" => $insertDataArray,
                  "table_name" => 'employee'
                ); 
                $insert_res = $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata);
                $insert_data = json_decode($insert_res);
                $user_id=$insert_data->data->insertId;
                  $user_id=session()->set('employee_id', $user_id);
                  session()->set('email_id', $email_id);
                $planInfoString = 'We’re excited to have you on board! Please <a href="'.base_url('login').'" style="color: #1a73e8;">log in</a>.';  
                $this->sendSignupEmail($planInfoString,$email_id);
                $payment_display = $_SESSION['payment_display'] ?? '';
                $valid_upto = $_SESSION['valid_upto'] ?? '';
                if ($payment_display == '1') {

                    return redirect()->to('SignUpSubscription');

                } elseif (!empty($valid_upto)) {

                    $this->add_user_subscription($valid_upto);
                    $this->user_login_process($email_id,$password);
                    return redirect()->to('MyVault');
                    exit;

                } else {

                    return redirect()->to('SignUpSubscription');

                }
            }
            //echo "<pre>";print_r($insert_data);exit;
            ///////////// Default plan setup ///////////
            // if(!empty($insert_data->data)){
            //     $this->sendVerifyOtpEmail($insert_data->data->insertId, $email_id, $phone);
            // } 
            // /////////////// END ////////////////////////
            // return redirect()->to(base_url('verify-phone')); exit;            
        }

     }
    public function add_user_subscription($valid_upto)
    { 
        $insertDataArray1 = array();
        $insert = array(
            "user_id" => $_SESSION['employee_id'],
            "subscription_id" => 0,
            "start_date" => date('Y-m-d'),
            "end_date" => date('Y-m-d', strtotime('+'.$valid_upto.' months')),
            "price" => 0,
            "payment_status" => 1,
            "stripeToken" => 'default',
            "stripeTokenType" => 'signup',
            "stripeEmail" => $_SESSION['email_id'],
             "volume_inGB" => $_SESSION['org_memory'],
            "current_period_start" => date('Y-m-d'),
            "current_period_end" => date('Y-m-d', strtotime('+'.$valid_upto.' months'))
        );
        array_push($insertDataArray1,$insert);  

        $apidata1 = array(
            "table_name" => "user_subscription",
            "insertDataArray" => $insertDataArray1,
        );
        $id = $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata1);
        //echo $id;exit;
    }
    public function user_login_process($username, $psw)
    {
        $datalist = [
            "userName" => $username,
            "password" => $psw
        ];

        //echo "<pre>";print_r($datalist);exit;

        $result = $this->curl->curl_call(APIURL . "TrickedOutLogin", $datalist);
        $user = json_decode($result);
        //echo "<pre>";print_r($user);exit;
       
        $this->session->set([
            'employee_id' => $user->data[0]->employee_id,
            'email_id' => $user->data[0]->email_id,
            'first_name' => $user->data[0]->first_name,
            'last_name' => $user->data[0]->last_name,
            'phone' => $user->data[0]->phone,
            'member_link_signup' => $user->data[0]->member_link_signup,
            'employee_role' => $user->data[0]->employee_role,
            'loggedIn' => true
        ]);     
    }     
     private function sendSignupEmail($planInfoString='',$email){
            $body = '<table width="90%" border="0" cellspacing="5" cellpadding="5" style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
          <tr>
          <td>
          <img src="'.base_url().'/assets/images/tricked_logo1.png" style="width:60%;" alt="Tricked Out Logo">
          </td>
          </tr>
          <tr>
          <td>Hello,</td>
          </tr>
          <tr>
          <td>Welcome to <strong>Tricked Out</strong>! Your registration was successful.</td>
          </tr>
          <tr>
          <td>'.$planInfoString.'</td>
          </tr>
          <tr>
          <td>To get started, simply log in to your account using the link below:</td>
          </tr>
          <tr>
          <td><a href="'.base_url().'" style="color: #1a73e8;">Log In to Your Account</a></td>
          </tr>
          <tr>
          <td>If you have any questions or need help, feel free to contact our support team (info@trickedoutmagic.com).</td>
          </tr>
          <tr>
          <td>Thanks for joining us!<br>The Tricked Out Team</td>
          </tr>
          </table>
          ';
          $mailer = new Mailer();
            //$to = 'bamadebupadhya@gmail.com';
          $to = $email;
          $subject = 'Tricked Out - signup';  
          $mail = $mailer->sendMail($to, $subject, $body);
     }
     private function sendVerifyOtpEmail($userId, $email, $phone)
    {

        //echo $userId .','. $email.','. $phone;exit;
        $otp = rand(100000, 999999);
        $otpExpiry = 5;

            // Insert OTP in DB
        $insertDataArray = [];
        $insertData = [
            "user_id" => $userId,
            "otp" => $otp,
            "expires_at" => date('Y-m-d H:i:s', strtotime("+$otpExpiry minutes"))
        ];

        array_push($insertDataArray, $insertData);

        $insert = [
            "insertDataArray" => $insertDataArray,
            "table_name" => "login_otp"
        ];

        $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows', $insert);
        session()->set('otp_user_id', $userId);
        session()->set('otp_phone', $phone);                        
        session()->set('otp_email', $email); 
        //session()->set('promotion_code_id',$promotion_code_id);                          
            // Email Body
        $body = '
        <table width="90%" style="font-family: Arial; font-size:14px;">
        <tr>
        <td>
        <img src="'.base_url().'/assets/images/tricked_logo1.png" width="200">
        </td>
        </tr>
        <tr><td>Hello,</td></tr>
        <tr>
        <td>
        Welcome to <strong>Tricked Out</strong> 
        </td>
        </tr>
        <tr>
        <td>Your verification OTP:</td>
        </tr>
        <tr>
        <td style="font-size:20px;font-weight:bold">'.$otp.'</td>
        </tr>
        <tr>
        <td>This OTP is valid for '.$otpExpiry.' minutes.</td>
        </tr>
        <tr>
        <td>Thanks,<br><b>Tricked Out Team</b></td>
        </tr>
        </table>';

        $mailer = new Mailer();
        $subject = 'Tricked Out - Email Verification';

        return $mailer->sendMail($email, $subject, $body);
    }   
    public function verifyEmailInOrganization()
    {
             $email = $this->request->getVar('email');
             $orgid = $this->request->getVar('orgid');
             $association = $this->request->getVar('association');

             $params1 = array(
                "fieldName" => 'email_id',
                "fieldValue" => $email
             );

            $result2 =$this->curl->curl_call(APIURL."TrickedOutFieldValueByFieldName",$params1);
            $user_exist = json_decode($result2);
            //echo "<pre>";print_r($user_exist);
            if (!empty($user_exist->data) && isset($user_exist->data[0]->employee_id)) {
                // $this->session->setFlashdata('err_msg', 'The email ID is already registered, please login.');
                // return redirect()->to(base_url('login'));exit;
                return $this->response->setJSON(['status' => false, 'err_msg' => 'The email ID is already registered, please login.']);
            }
             
             $parameter = array(
                "email_id" => $email,
                "org_id" => $orgid
             );

             $tempVerify =$this->curl->curl_call(APIURL."TrickedOutVarifyAssociationMember",$parameter);
             $userExist = json_decode($tempVerify);
             //echo "<pre>";print_r($resultExist);exit;

             if($association == 1 && empty($userExist->data[0]->id)){ 
                // $this->session->setFlashdata('err_msg', 'The email ID is not qualified for the offer.');
                // return redirect()->to(base_url('organization/'.$org_code));exit; 
                return $this->response->setJSON(['status' => false, 'err_msg' => 'The email ID is not qualified for the offer.']);
             } else if (!empty($userExist->data[0]->org_id) && $userExist->data[0]->org_id != $orgid) {
                //  $this->session->setFlashdata('err_msg', 'The email ID is mapped with other association.');
                // return redirect()->to(base_url('organization/'.$org_code));exit;
                return $this->response->setJSON(['status' => false, 'err_msg' => 'The email ID is mapped with other association.']);
             } 
            $userdata = (object)[
                'org_id' => '',
                'phone' => '',
                'email_id' => '',
                'firstname' => '',
                'lastname' => ''
            ];

            if(!empty($userExist->data)) {
                $userdata = $userExist->data[0];
            }             
            return $this->response->setJSON(['status' => true, 'userdata' => $userdata]);

    }
}
