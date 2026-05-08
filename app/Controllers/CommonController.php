<?php
/**
*  @category   User login
 * @package    Controller
 * @author     Padma
 * @copyright  2024 Karma
*/
namespace App\Controllers;
use App\Libraries\Mailer;
//use App\Libraries\Snssms;
use App\Services\TwilioService;
class CommonController extends BaseController
{       

    public function login()
    {
        $data = [
            'title' => 'LOGIN :: ' . PAGETITLE,
            'pageHeading' => 'LOGIN',
        ];

        if ($this->request->getMethod() === 'post') {

            $datalist = [
                "userName" => $this->request->getVar('userName'),
                "password" => $this->request->getVar('password')
            ];

            $result = $this->curl->curl_call(APIURL . "TrickedOutLogin", $datalist);
            $user = json_decode($result);

            if (!empty($user->data[0])) {

                $otp = rand(100000, 999999);
                $phone = $user->data[0]->phone;
                $email = $this->request->getVar('userName');
                $otpExpiry = 5;
                $insertDataArray = array(); 
                $insertData = array(                 
                    "user_id" => $user->data[0]->employee_id,
                    'otp' => $otp,
                    'expires_at' => date('Y-m-d H:i:s', strtotime('+'.$otpExpiry.' minutes'))     
                );
                array_push($insertDataArray,$insertData);                    
                $insert = array(
                    "insertDataArray" => $insertDataArray,
                    "table_name" => 'login_otp'
                ); 
                $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert); 


                // Send OTP

                $message = "Your TrickedOut login OTP is $otp.";
                $twilio = new TwilioService();
                    //$sent = $twilio->sendSMS($phone, $message);
                    //echo "<pre>123:";print_r($sent);exit;
                // Store user id temporarily
                session()->set('otp_user_id', $user->data[0]->employee_id);
                session()->set('otp_phone', $phone);
                session()->set('otp_email', $email);



                    //////////////Login OTP
                $body = '<table width="90%" border="0" cellspacing="5" cellpadding="5" style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
                <tr>
                <td>
                <img src="'.base_url().'/assets/images/tricked_logo1.png" style="width:200px;" alt="Tricked Out Logo">
                </td>
                </tr>
                <tr>
                <td>Hello,</td>
                </tr>
                <tr>
                <td>
                We noticed a login attempt to your <strong>Tricked Out</strong> account.
                </td>
                </tr>
                <tr>
                <td>
                To continue logging in, please enter the One-Time Password (OTP) below:
                </td>
                </tr>
                <tr>
                <td style="font-size:18px; font-weight:bold; letter-spacing:2px; padding:10px 0;">
                '.$otp.'
                </td>
                </tr>
                <tr>
                <td>
                This OTP is valid for the next <strong>'.$otpExpiry.' minutes</strong>.
                For security reasons, please do not share this code with anyone.
                </td>
                </tr>
                <tr>
                <td>
                If you did not attempt to log in, please ignore this email or contact our support team (info@trickedoutmagic.com) immediately.
                </td>
                </tr>
                <tr>
                <td>
                Thanks,<br>
                <strong>The Tricked Out Team</strong>
                </td>
                </tr>
                </table>';


                $mailer = new Mailer();
                //$to = 'bamadebupadhya@gmail.com';
                $to = $email;
                $subject = 'Tricked Out - Login OTP';  
                $mail = $mailer->sendMail($to, $subject, $body);
                //echo "<pre>";print_r($user);exit;
                if($user->data[0]->employee_role == 'Admin'){
                //echo "1";
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
                    return  redirect()->to(base_url('user')); 
                    exit;
                }elseif($user->data[0]->is_verified){
                    return redirect()->to(base_url('verify-otp'));
                }else{

                    return redirect()->to(base_url('verify-phone'));
                }

            }

            $this->session->setFlashdata('err_msg', 'Invalid username or password');
            return redirect()->to(base_url('login'));
        }

        return view('login/loginView', $data);
    }

    public function verifyOtp()
    {
        if ($this->request->getMethod() === 'post') {

        //$enteredOtp = $this->request->getVar('otp');
        $otp = implode('', $this->request->getVar('otp')); // combines the 6 digits
        $userId = session()->get('otp_user_id');
        $datalist = [
            "userId" => $userId,
            "otp" => $otp,
            "current_time" => date('Y-m-d H:i:s')
        ];

        $result = $this->curl->curl_call(APIURL . "TrickedOutVerifyOTP", $datalist);
        $user = json_decode($result);
        //echo "<pre>";print_r($user);//exit;
        if (!empty($user->data[0])) {
                //////////////Signup success mail

            $data_file = array(
                "is_used" => 1
            );
            $update_data = array(
                "id_field_name" => "id",
                "id_field_value" => $user->data[0]->id,
                "table_name" => "login_otp",
                "updateData" => $data_file
            );
            $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data); 

            $userdata = [
                "userId" => $userId
            ];

            $result = $this->curl->curl_call(APIURL . "TrickedOutGetUserByID", $userdata);
            $userData = json_decode($result);
            //echo "<pre>123";print_r($userData);//exit;
            $user = $userData->data[0];
            $this->session->set([
                'employee_id' => $user->employee_id,
                'email_id' => $user->email_id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone,
                'employee_role' => $user->employee_role,
                'member_link_signup' => $user->member_link_signup,
                'loggedIn' => true
            ]);
            //echo $user->employee_role."::".$user->user_id;
            //echo "<pre>555";print_r($user);
        if($user->employee_role == 'Admin'){
                //echo "1";
              return  redirect()->to(base_url('plan')); 
              exit;
          }else if(!$user->user_id){
                //echo "2";
              return  redirect()->to(base_url('SignUpSubscription'));
              exit;
          }else{
                //echo "3";
             return redirect()->to(base_url('MyVault'));
             exit;
         }

     }

//exit;


     return redirect()->back()->with('err_msg', 'Invalid or expired OTP');
 }

 return view('login/otpView');
}
public function verifyUser(){
    if ($this->request->getMethod() === 'post') {
        $verify_type = $this->request->getVar('verify_type');
        $verifyto = $this->request->getVar('verifyto');
        $sent=$this->sendVerifyOtpToUser($verify_type,$verifyto);
            return $this->response->setJSON([
                'status' => true,
                'message' => 'OTP sent'
            ]);
    }
}
public function verifyUserOtp()
{
    $otp = $this->request->getPost('otp');
    $email = $this->request->getPost('email');

    // if(session()->get('email_otp') == $otp){
    //     return $this->response->setJSON(['status' => true]);
    // }

    

        $datalist = [
            "verify_to" => $email,
            "otp" => $otp,
            "current_time" => date('Y-m-d H:i:s')
        ];

        $result = $this->curl->curl_call(APIURL . "TrickedOutVerifyUserOTP", $datalist);
        $user = json_decode($result);
        //echo "<pre>";print_r();
        //echo "<pre>";print_r($user);//exit;
        if (!empty($user->data[0])) {
                //////////////Signup success mail

            $data_file = array(
                "is_used" => 1
            );
            $update_data = array(
                "id_field_name" => "id",
                "id_field_value" => $user->data[0]->id,
                "table_name" => "verify_otp",
                "updateData" => $data_file
            );
            $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data); 

            
            return $this->response->setJSON(['status' => true]);
        }else{
            return $this->response->setJSON(['status' => false]);
        }


}
//     public function verifyOtp()
//     {
//         if ($this->request->getMethod() === 'post') {

//         //$enteredOtp = $this->request->getVar('otp');
//         $otp = implode('', $this->request->getVar('otp')); // combines the 6 digits
//         $userId = session()->get('otp_user_id');
//         $datalist = [
//             "userId" => $userId,
//             "otp" => $otp,
//             "current_time" => date('Y-m-d H:i:s')
//         ];

//         $result = $this->curl->curl_call(APIURL . "TrickedOutVerifyOTP", $datalist);
//         $user = json_decode($result);
//         //echo "<pre>";print_r($user);//exit;
//         if (!empty($user->data[0])) {
//                 //////////////Signup success mail

//             $data_file = array(
//                 "is_used" => 1
//             );
//             $update_data = array(
//                 "id_field_name" => "id",
//                 "id_field_value" => $user->data[0]->id,
//                 "table_name" => "login_otp",
//                 "updateData" => $data_file
//             );
//             $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data); 

//             $userdata = [
//                 "userId" => $userId
//             ];

//             $result = $this->curl->curl_call(APIURL . "TrickedOutGetUserByID", $userdata);
//             $userData = json_decode($result);
//             //echo "<pre>123";print_r($userData);//exit;
//             $user = $userData->data[0];
//             $this->session->set([
//                 'employee_id' => $user->employee_id,
//                 'email_id' => $user->email_id,
//                 'first_name' => $user->first_name,
//                 'last_name' => $user->last_name,
//                 'phone' => $user->phone,
//                 'employee_role' => $user->employee_role,
//                 'loggedIn' => true
//             ]);
//             //echo $user->employee_role."::".$user->user_id;
//             //echo "<pre>555";print_r($user);
//         if($user->employee_role == 'Admin'){
//                 //echo "1";
//               return  redirect()->to(base_url('plan')); 
//               exit;
//           }else if(!$user->user_id){
//                 //echo "2";
//               return  redirect()->to(base_url('SignUpSubscription'));
//               exit;
//           }else{
//                 //echo "3";
//              return redirect()->to(base_url('MyVault'));
//              exit;
//          }

//      }

// //exit;
// }

//      return redirect()->back()->with('err_msg', 'Invalid or expired OTP');
//  }
public function resendOtp()
{
    $userId = session()->get('otp_user_id');
    $phone = session()->get('otp_phone');    
    $email = session()->get('otp_email');

    if (!$userId) {
        return redirect()->to('login')->with('err_msg', 'Session expired. Please login again.');
    }

    
    $currentDateTime = date('Y-m-d H:i:s');
    $userdata = [
        "userId" => $userId,
        "currentDateTime" => $currentDateTime
    ];

    $result = $this->curl->curl_call(APIURL . "TrickedOutGetValidOTPByUserID", $userdata);
    $userData = json_decode($result);
       // $otpRow = $userData->data[0];
    $otpExpiry = 5;
       // echo "<pre>";print_r($userData);exit;
    // If valid OTP exists → reuse
    if (!empty($userData->data[0])) {
        $otp = $userData->data[0]->otp;
        $otpId = $userData->data[0]->id;
        $data_file = array(
            "expires_at" => date('Y-m-d H:i:s', strtotime('+'.$otpExpiry.' minutes'))
        );
        $update_data = array(
            "id_field_name" => "id",
            "id_field_value" => $otpId,
            "table_name" => "login_otp",
            "updateData" => $data_file
        );
        $result=$this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
    } else {
        // OTP expired → generate new
        $otp = rand(100000, 999999);

                // session()->set('otp_user_id', $user->data[0]->employee_id);
                // session()->set('otp_phone', $phone);
                // session()->set('otp_email', $email);

        $insertDataArray = array(); 
        $insertData = array(                 
            "user_id" => $userId,
            'otp' => $otp,
            'expires_at' => date('Y-m-d H:i:s', strtotime('+'.$otpExpiry.' minutes'))     
        );
        array_push($insertDataArray,$insertData);                    
        $insert = array(
            "insertDataArray" => $insertDataArray,
            "table_name" => 'login_otp'
        ); 
        $result=$this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$insert);

    }

    // Get user phone

    // Send OTP again
    $message = "Your TrickedOut login OTP is $otp.";
    $twilio = new TwilioService();
    //$twilio->sendSMS($phone, $message);
                    //////////////Login OTP
    $body = '<table width="90%" border="0" cellspacing="5" cellpadding="5" style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
    <tr>
    <td>
    <img src="'.base_url().'/assets/images/tricked_logo1.png" style="width:200px;" alt="Tricked Out Logo">
    </td>
    </tr>
    <tr>
    <td>Hello,</td>
    </tr>
    <tr>
    <td>
    We noticed a login attempt to your <strong>Tricked Out</strong> account.
    </td>
    </tr>
    <tr>
    <td>
    To continue logging in, please enter the One-Time Password (OTP) below:
    </td>
    </tr>
    <tr>
    <td style="font-size:18px; font-weight:bold; letter-spacing:2px; padding:10px 0;">
    '.$otp.'
    </td>
    </tr>
    <tr>
    <td>
    This OTP is valid for the next <strong>'.$otpExpiry.' minutes</strong>.
    For security reasons, please do not share this code with anyone.
    </td>
    </tr>
    <tr>
    <td>
    If you did not attempt to log in, please ignore this email or contact our support team (info@trickedoutmagic.com) immediately.
    </td>
    </tr>
    <tr>
    <td>
    Thanks,<br>
    <strong>The Tricked Out Team</strong>
    </td>
    </tr>
    </table>';


    $mailer = new Mailer();
                //$to = 'bamadebupadhya@gmail.com';
    $to = $email;
    $subject = 'Tricked Out - Resent OTP';  
    $mail = $mailer->sendMail($to, $subject, $body);
    return redirect()->back()->with('success_msg', 'OTP has been resent.');
    //return redirect()->to(base_url('verify-otp'));
}


public function signup(){

    try{
        unset($_SESSION['payment_display'], $_SESSION['valid_upto'], $_SESSION['org_memory']);
        $data = [
            'title'   => 'SIGNUP :: '.PAGETITLE,
            'pageHeading' => 'SIGNUP'
        ]; 

        if($this->request->getMethod() == 'post'){
                 //echo "<pre>";print_r($_POST);exit;
            $referer = $this->request->getServer('HTTP_REFERER');
                //echo $referer."::".base_url();exit;
            if (!$referer || strpos($referer, base_url()) !== 0) {
                exit('Invalid request source');
            }
            if ($this->request->getPost('form_token') !== session()->get('form_token')) {
                exit('Invalid token');
            }
            $token = $this->request->getPost('recaptcha_token');

            $secret = getenv('RECAPTCHA_SECRET_KEY');

            $response = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret="
                .$secret."&response=".$token
            );

            $result = json_decode($response);
            if (!$result || !$result->success || $result->score < 0.3) {
                session()->setFlashdata('err_msg', 'We could not verify your request. Please try again.');
                return redirect()->back();
            }
            $countryCode = $this->request->getPost('country_code');
            $phone = $this->request->getVar('phone');
            $phone = str_replace("(","",$phone);
            $phone = str_replace(")","",$phone);
            $phone = str_replace(" ","",$phone);
            $phone = str_replace("-","",$phone);
            $phone = $countryCode . $phone;
            $email = $this->request->getVar('email_id');
            $string = $this->request->getVar('password');
            $password = str_replace(' ', '', $string);
            $promotion_code_id = $this->request->getVar('promotion_code_id');

            $params = array(
                "fieldName" => 'phone',
                "fieldValue" => $phone
            );
            $result =$this->curl->curl_call(APIURL."TrickedOutFieldValueByFieldName",$params);
            $user_phone = json_decode($result); 
            if(!empty($user_phone->data)){
                $exist_user = $user_phone->data[0];
                if($exist_user->is_verified==0){
                    //echo "<pre>";print_r($user_email);exit;
                    $this->sendVerifyOtpEmail($exist_user->employee_id, $exist_user->email_id, $exist_user->phone);
                    return redirect()->to(base_url('verify-phone')); exit;
                }                
                session()->setFlashdata('err_msg', 'Phone number already exists. Unable to register.');
            }
            $params1 = array(
                "fieldName" => 'email_id',
                "fieldValue" => $email
            );
            $result1 =$this->curl->curl_call(APIURL."TrickedOutFieldValueByFieldName",$params1);
            $user_email = json_decode($result1); 
            if(!empty($user_email->data)){
                $exist_user = $user_email->data[0];
                if($exist_user->is_verified==0){
                    //echo "<pre>";print_r($user_email);exit;
                    $this->sendVerifyOtpEmail($exist_user->employee_id, $exist_user->email_id, $exist_user->phone);
                    return redirect()->to(base_url('verify-phone')); exit;
                }
                session()->setFlashdata('err_msg', 'Email already exists. Unable to register.');  
            } 

            if(empty($user_email->data) && empty($user_phone->data)){ 
                $insertDataArray = array();
                $insertData = array(
                    "first_name" => $this->request->getVar('first_name'),
                    "last_name" => $this->request->getVar('last_name'),
                    "phone" => $phone,
                    "type" => 'User',
                    "employee_role" => 'User',
                    "email_id" => $this->request->getVar('email_id'),
                    "password" => $password,
                    "promotion_code_id" => $this->request->getVar('promotion_code_id')  
                );
                array_push($insertDataArray,$insertData);   
                $apidata = array(
                    "table_name" => "employee",
                    "insertDataArray" => $insertDataArray,
                );
                $insert_res = $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata);
                $insert_data = json_decode($insert_res);  

                    ///////////// Default plan setup ///////////
                if(!empty($insert_data->data)){

                    
                    $this->sendVerifyOtpEmail($insert_data->data->insertId, $email, $phone);
                } 
                    /////////////// END ////////////////////////
                    //session()->setFlashdata('err_msg', 'Thank you for signing up.');
                return redirect()->to(base_url('verify-phone')); exit;  
            } 
        }

    } catch (\Exception $e) {
        exit($e->getMessage());
    }
    session()->set('form_token', bin2hex(random_bytes(32)));
    //This section is for stripe subscriptions
        $stripeService = new \App\Libraries\StripeService();

        $promotion_code_id = session()->get('promotion_code_id') ?? '';

        $response = $stripeService->getStripeProductsWithPaymentLinks($promotion_code_id);
        //echo "<pre>";print_r($response);exit;
        $data['subscriptions'] = $response['data'] ?? [];
    return view('login/signup',$data);
}
public function signup_without_otp(){
    try{
        unset($_SESSION['payment_display'], $_SESSION['valid_upto'], $_SESSION['org_memory']);
        $data = [
            'title'   => 'SIGNUP :: '.PAGETITLE,
            'pageHeading' => 'SIGNUP'
        ]; 
        if($this->request->getMethod() == 'post'){
                 //echo "<pre>";print_r($_POST);exit;
            $referer = $this->request->getServer('HTTP_REFERER');
                //echo $referer."::".base_url();exit;
            if (!$referer || strpos($referer, base_url()) !== 0) {
                exit('Invalid request source');
            }
            if ($this->request->getPost('form_token') !== session()->get('form_token')) {
                exit('Invalid token');
            }
            $token = $this->request->getPost('recaptcha_token');
            $secret = getenv('RECAPTCHA_SECRET_KEY');
            $response = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret="
                .$secret."&response=".$token
            );
            $result = json_decode($response);
            if (!$result || !$result->success || $result->score < 0.3) {
                session()->setFlashdata('err_msg', 'We could not verify your request. Please try again.');
                return redirect()->back();
            }
            $countryCode = $this->request->getPost('country_code');
            $phone = $this->request->getVar('phone');
            $phone = str_replace("(","",$phone);
            $phone = str_replace(")","",$phone);
            $phone = str_replace(" ","",$phone);
            $phone = str_replace("-","",$phone);
            $phone = $countryCode . $phone;
            $email = $this->request->getVar('email_id'); 
            $string = $this->request->getVar('password');
            $password = str_replace(' ', '', $string);
            $promotion_code_id = $this->request->getVar('promotion_code_id'); 
            $params = array(
                "fieldName" => 'phone',
                "fieldValue" => $phone
            );
            $result =$this->curl->curl_call(APIURL."TrickedOutFieldValueByFieldName",$params);
            $user_phone = json_decode($result); 
            if(!empty($user_phone->data)){
                $exist_user = $user_phone->data[0];
                if($exist_user->is_verified==0){
                    //echo "<pre>";print_r($user_email);exit;
                    $this->sendVerifyOtpEmail($exist_user->employee_id, $exist_user->email_id, $exist_user->phone);
                    return redirect()->to(base_url('verify-phone')); exit;
                }                
                session()->setFlashdata('err_msg', 'Phone number already exists. Unable to register.');
            }
            $params1 = array(
                "fieldName" => 'email_id',
                "fieldValue" => $email
            );
            $result1 =$this->curl->curl_call(APIURL."TrickedOutFieldValueByFieldName",$params1);
            $user_email = json_decode($result1); 
            if(!empty($user_email->data)){
                $exist_user = $user_email->data[0];
                if($exist_user->is_verified==0){
                    //echo "<pre>";print_r($user_email);exit;
                    $this->sendVerifyOtpEmail($exist_user->employee_id, $exist_user->email_id, $exist_user->phone);
                    return redirect()->to(base_url('verify-phone')); exit;
                }
                session()->setFlashdata('err_msg', 'Email already exists. Unable to register.');  
            } 

            if(empty($user_email->data) && empty($user_phone->data)){ 
                $insertDataArray = array();
                $insertData = array(
                    "first_name" => $this->request->getVar('first_name'),
                    "last_name" => $this->request->getVar('last_name'),
                    "phone" => $phone,
                    "type" => 'User',
                    "employee_role" => 'User',
                    "email_id" => $this->request->getVar('email_id'),
                    "password" => $password,
                    "promotion_code_id" => $this->request->getVar('promotion_code_id'),
                    "is_verified" => 1  
                );
                array_push($insertDataArray,$insertData);   
                $apidata = array(
                    "table_name" => "employee",
                    "insertDataArray" => $insertDataArray,
                );
                $insert_res = $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata);
                $insert_data = json_decode($insert_res);  

                    ///////////// Default plan setup ///////////
                if (empty($insert_data->data)) {
                    return redirect()->back()->with('err_msg', 'Signup failed.');
                }

                // ✅ Get user ID
                $userId = $insert_data->data->insertId;

                // ✅ Store session
                $_SESSION['employee_id'] = $userId;
                $_SESSION['email_id']    = $email;

                // ✅ Get Stripe details from form
                $paymentUrl = $this->request->getPost('payment_link'); // ⚠️ match your input name
                $priceId    = $this->request->getPost('price_id');
                $promo_code = $this->request->getPost('coupon_code');

                if (!$paymentUrl || !$priceId) {
                    return redirect()->back()->with('err_msg', 'Invalid plan selection');
                }

                // ✅ Build Stripe redirect URL
                $params = [
                    'client_reference_id' => $userId,
                    'prefilled_email'     => $email
                ];

                if (!empty($promo_code)) {
                    $params['prefilled_promo_code'] = $promo_code;
                }

                $redirectUrl = $paymentUrl . '?' . http_build_query($params);

                // 🚀 Redirect to Stripe
                return redirect()->to($redirectUrl);exit; 
            } 
        }

    } catch (\Exception $e) {
        exit($e->getMessage());
    }
    session()->set('form_token', bin2hex(random_bytes(32)));
    //This section is for stripe subscriptions
        $stripeService = new \App\Libraries\StripeService();

        $promotion_code_id = session()->get('promotion_code_id') ?? '';

        $response = $stripeService->getStripeProductsWithPaymentLinks($promotion_code_id);
        //echo "<pre>";print_r($response);exit;
        $data['subscriptions'] = $response['data'] ?? [];
    return view('login/signup_without_otp',$data);
}
public function getSubscriptionPlans()
{
    $stripeService = new \App\Libraries\StripeService();

    $promotion_code_id = $this->request->getPost('promotion_code_id') ?? '';
    
    $response = $stripeService->getStripeProductsWithPaymentLinks($promotion_code_id);
    //return $response;
    $data['subscriptions'] = $response['data'] ?? [];

    return view('login/SubscriptionCardsView', $data); // ONLY plans HTML
}
private function checkEmailExist(){
    
}
private function sendVerifyOtpToUser($verifyType,$verifyTo)
{
    $otp = rand(100000, 999999);
    $otpExpiry = 5;

        // Insert OTP in DB
    $insertDataArray = [];
    $insertData = [
        "verify_type" => $verifyType,
        "verify_to" => $verifyTo,
        "otp" => $otp,
        "expires_at" => date('Y-m-d H:i:s', strtotime("+$otpExpiry minutes"))
    ];

    array_push($insertDataArray, $insertData);

    $insert = [
        "insertDataArray" => $insertDataArray,
        "table_name" => "verify_otp"
    ];

    $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows', $insert);
    // session()->set('otp_user_id', $userId);
    // session()->set('otp_phone', $phone);                        
    // session()->set('otp_email', $email); 
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

    return $mailer->sendMail($verifyTo, $subject, $body);
} 
private function sendVerifyOtpEmail($userId, $email, $phone)
{
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
public function verifyPhone()
{
    if ($this->request->getMethod() === 'post') {

        //$enteredOtp = $this->request->getVar('otp');
        $otp = implode('', $this->request->getVar('otp')); // combines the 6 digits
        $userId = session()->get('otp_user_id');
        $datalist = [
            "userId" => $userId,
            "otp" => $otp,
            "current_time" => date('Y-m-d H:i:s')
        ];

        $result = $this->curl->curl_call(APIURL . "TrickedOutVerifyOTP", $datalist);
        $user = json_decode($result);
        //echo "<pre>";print_r($user);exit;
        if (!empty($user->data[0])) {
            $user_id = $user->data[0]->user_id;
            $email = session()->get('otp_email');            
            ///////////Get plan info
            $parameters = array(
                "status" => '-1'
            );
            $res=$this->curl->curl_call(APIURL.'TrickedOutSubscriptionMasterList',$parameters);

            $plan = json_decode($res); 
            //echo "<pre>";print_r($plan);exit;
            if(count($plan->data)){////Checking for default plan avalable
                $months = (($plan->data[0]->for_year*12) + $plan->data[0]->for_month);
                //echo "<pre>";print_r($months);exit; 
                $planInfoString = "We’re excited to have you on board. As a welcome gift, we’ve activated a <strong>free ".$months." month plan</strong> on your account. This plan gives you access to all basic features and <strong>".$plan->data[0]->volume_inGB."GB of space</strong> for your trick files.";
                $insertDataArray1 = array();
                $insert = array(
                    "user_id" => $user_id,
                    "subscription_id" => $plan->data[0]->id,
                    "start_date" => date('Y-m-d'),
                    "end_date" => date('Y-m-d', strtotime('+'.$months.' months')),
                    "price" => $plan->data[0]->price,
                    "payment_status" => 1,
                    "stripeToken" => 'default',
                    "stripeTokenType" => 'signup',
                    "stripeEmail" => $email 
                );
                array_push($insertDataArray1,$insert);  

                $apidata1 = array(
                    "table_name" => "user_subscription",
                    "insertDataArray" => $insertDataArray1,
                );
                $sub_res = $this->curl->curl_call(APIURL.’TrickedOutInsertMultipleRows’,$apidata1);
                $sub_data = json_decode($sub_res);
                if (empty($sub_data->data)) {
                    $planInfoString = "We’re excited to have you on board! Please <a href=\"" . base_url(‘SignUpSubscription’) . "\" style=\"color: #1a73e8;\">subscribe to a plan</a> to start managing your tricks.";
                }
            }else{
              $planInfoString = "We’re excited to have you on board! Please <a href=\"" . base_url(‘login’) . "\" style=\"color: #1a73e8;\">log in</a> and subscribe to a plan to start managing your tricks.";  
        } 
                       //////////////Signup success mail

          $data_file = array(
            "is_used" => 1
        );
          $update_data = array(
            "id_field_name" => "id",
            "id_field_value" => $user->data[0]->id,
            "table_name" => "login_otp",
            "updateData" => $data_file
        );
          $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data); 

                //////////////Signup success mail

          $data_file = array(
            "is_verified" => 1
        );
          $update_data = array(
            "id_field_name" => "employee_id",
            "id_field_value" => $user_id,
            "table_name" => "employee",
            "updateData" => $data_file
        );
          $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);      
          session()->set('employee_id', $user_id);
          session()->set('email_id', $email);

                //session()->set('otp_phone', $phone);    email_id                    
                //session()->set('otp_email', $email);             
                //$planInfoString = session()->get('otp_planInfoString');

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
          session()->setFlashdata('err_msg', 'Thank you for signing up.');
          //echo "<pre>";print_r($_SESSION);exit;
          //return redirect()->to('SignUpSubscription');

            $payment_display = $_SESSION['payment_display'] ?? '';
            $valid_upto = $_SESSION['valid_upto'] ?? '';

            if ($payment_display == '1') {

                return redirect()->to('SignUpSubscription');

            } elseif (!empty($valid_upto)) {

                $this->add_user_subscription($valid_upto);
                return redirect()->to('login');
                exit;

            } else {

                return redirect()->to('SignUpSubscription');

            }
      }

      return redirect()->back()->with('err_msg', 'Invalid or expired OTP');
  }

  return view('login/verifyPhoneView');
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

public function forgot_password()
{     

    try{

        $data = [
            'title'   => 'FORGOT PASSWORD :: '.PAGETITLE,
            'pageHeading' => 'FORGOT PASSWORD', 
        ]; 

        if($this->request->getMethod() == 'post'){
                 //echo "<pre>";print_r($_POST);exit; 
            $email = $this->request->getVar('email_id'); 

            $params = array(
                "fieldName" => 'email_id',
                "fieldValue" => $email
            );
            $result =$this->curl->curl_call(APIURL."TrickedOutFieldValueByFieldName",$params);
            $user_email = json_decode($result); 


            if(empty($user_email->data)){
                session()->setFlashdata('err_msg', 'Invalid username.');  
            }else{
                $employee_id = $user_email->data[0]->employee_id; 
                $temppassword_expiration = date("Y-m-d H:i:s", strtotime('+720 hours')); 
                $temppassword = $this->generateRandomString(20);
                $data['temppassword_expiration'] = $temppassword_expiration;  
                $data_file = array(
                    "temppassword" => $temppassword,
                    "temppassword_expiration"=> $temppassword_expiration
                );
                $update_data = array(
                    "id_field_name" => "employee_id",
                    "id_field_value" => $employee_id,
                    "table_name" => "employee",
                    "updateData" => $data_file
                );
                $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data);
                $resetLink = base_url()."/resetpassword/".$temppassword;
                    /*$body = '<table width="90%" border="0" cellspacing="5" cellpadding="5">

                        <tr>
                        <td width="100%"><img src="https://www.trickedoutvault.com/assets/images/login-bg.jpg" style="width:60%;"></td>
                        </tr>
                        <tr>
                        <td width="100%"></td>
                        </tr>
                        <tr>
                        <td width="100%">Hello,</td>
                        </tr>
                        <tr>
                        <td width="100%"></td>
                        </tr>
                        <tr>
                        <td width="100%">We have received a request to reset your Tricked Out password.</td>
                        </tr>
                        <tr>
                        <td width="100%"></td>
                        </tr>
                        <tr>
                        <td width="100%">To reset your password, please click the link below. Your password won&lsquo;t be changed until you access this link and create a new one. This link is valid for 24 hours.</td>
                        </tr>
                        <tr>
                        <td width="100%"></td>
                        </tr>
                        <tr>
                        <td width="100%">'.$resetLink.'</td>
                        </tr>

                        </table>';*/
                        $body = '<table width="90%" border="0" cellspacing="5" cellpadding="5" style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
                        <tr>
                        <td width="100%">
                        <img src="'.base_url().'/assets/images/tricked_logo1.png" style="width:60%;" alt="Tricked Out Logo">
                        </td>
                        </tr>
                        <tr>
                        <td>Hello,</td>
                        </tr>
                        <tr>
                        <td>We have received a request to reset your Tricked Out password.</td>
                        </tr>
                        <tr>
                        <td>
                        To reset your password, please click the link below. Your password won’t be changed until you access this link and create a new one. This link is valid for 24 hours.
                        </td>
                        </tr>
                        <tr>
                        <td><a href="'.$resetLink.'" style="color: #1a73e8;">Reset Password</a></td>
                        </tr>
                        </table>';
                        $mailer = new Mailer();
                        //$to = 'bamadebupadhya@gmail.com';
                        $to = $email;
                        $subject = 'Tricked Out 2025 - Password Reset Request';  
                        $mail = $mailer->sendMail($to, $subject, $body);
                        //echo $body.'-----'.$mail;exit; 
                        if($mail){
                            session()->setFlashdata('err_msg', 'A link to reset your password has been sent to your email address: '.$to); 
                        } else{
                            session()->setFlashdata('err_msg', 'Error-in email send.'); 
                        }
                        //echo $body.'-----'.$mail;exit;  
                    } 
                }

            } catch (\Exception $e) {
                exit($e->getMessage());
            }
            return view('login/forgot_password',$data);
        }

        public function resetpassword()
        {        
            try{

                $temppassword = $this->request->uri->getSegment(2);
                $params = array(
                    "fieldName" => 'temppassword',
                    "fieldValue" => $temppassword
                );
                $result =$this->curl->curl_call(APIURL."TrickedOutFieldValueByFieldName",$params);
                $userdata = json_decode($result); 

                if($userdata->data){
                    $employee_id = $userdata->data[0]->employee_id;
                }else{
                    $employee_id = '';
                    session()->setFlashdata('err_msg1', 'Invalid token.'); 
                    return redirect()->to(base_url('login')); exit;
                }  

                $data = [
                    'title'   => 'RESET PASSWORD :: '.PAGETITLE,
                    'pageHeading' => 'RESET PASSWORD', 
                    'employee_id' => $employee_id
                ];  

            } catch (\Exception $e) {
                exit($e->getMessage());
            }
            return view('login/resetpassword',$data);
        }

        public function resetpassword_submit()
        { 
            try{  

                if($this->request->getMethod() == 'post'){
                //echo "<pre>";print_r($_POST);exit; 
                    $employee_id = $this->request->getVar('employee_id');
                //$password = $this->request->getVar('password'); 
                    $string = $this->request->getVar('password');
                    $password = str_replace(' ', '', $string);
                    if($employee_id){
                     //echo "<pre>";print_r($employee_id);exit; 
                     $data_file = array(
                        "temppassword" => "",
                        "password" => $password,
                        "temppassword_expiration"=> "",
                        "password_set_flag"=> 1
                    );
                     $update_data = array(
                        "id_field_name" => "employee_id",
                        "id_field_value" => $employee_id,
                        "table_name" => "employee",
                        "updateData" => $data_file
                    );
                     $this->curl->curl_call(APIURL.'TrickedOutUpdateTableMultipleFields',$update_data); 
                     session()->setFlashdata('err_msg', 'Your password has been reset! Please login with your new password.'); 
                 }else{ 
                    session()->setFlashdata('err_msg', 'Invalid token.');  
                } 
                return redirect()->to(base_url('login')); exit;

            }

        } catch (\Exception $e) {
            exit($e->getMessage());
        }

    }

    public function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    } 



    public function login2()
    {     

        try{

            $data = [
                'title'   => 'SIGN IN :: '.PAGETITLE,
                'pageHeading' => 'SIGN IN', 
            ];     


            if($this->request->getMethod() == 'post'){

                $datalist = array(
                    "userName" => $this->request->getVar('userName'),
                    "password" => $this->request->getVar('password')
                ); 

                $rules = [
                    "userName" => [
                        "label" => "Phone Number", 
                        "rules" => "required|regex_match[/^[0-9]{10}$/]"                    
                    ],
                    "password" => [
                        "label" => "Password", 
                        "rules" => "required|min_length[6]|max_length[15]"
                    ]
                ];

                if (!$this->validate($rules)) {
               // $this->session->setFlashData("error", "Enter valid phone number & password.");
                }

           // echo APIURL; exit;
            $result = $this->curl->curl_call(APIURL."login",$datalist); // calling method
            $user = json_decode($result);
            if(!empty($user->data[0]))
            {
                $parameters = array(
                    "role_id" => $user->data[0]->role_id
                ); 

                $result = $this->curl->curl_call(APIURL.API_GET_FUNCTION_SECURITY_BY_ROLE_ID,$parameters); // calling method
                $function_security = json_decode($result);
                //echo "<pre>";print_r($function_security);
                $function_security_array = array();
                foreach($function_security->data as $security){
                    $function_security_array[$security->code]=true;
                }

                $logindata = array(
                    'userId'  => $user->data[0]->id,
                    'companyId'  => $user->data[0]->company_id,
                    'per_step_cost'  => $user->data[0]->per_step_cost,
                    'per_day_cost'  => $user->data[0]->per_day_cost,
                    'role'     => $user->data[0]->role_id,
                    'firstName'     => $user->data[0]->first_name,
                    'lastName'     => $user->data[0]->last_name,
                    'phone'     => $user->data[0]->phone,
                    'email'     => $user->data[0]->email,
                    'roleName'     => $user->data[0]->role_name,                
                    'status'     => $user->data[0]->status,
                    'companyName'     => $user->data[0]->company_name,
                    'companyLogo'     => $user->data[0]->logo,
                    'parentCompanyId'  => $user->data[0]->compid,
                    'loggedIn' => TRUE,
                    'function_security' => $function_security_array
                ); 
            //set session data.
                $this->session->set($logindata); 

                if(!empty($_SESSION['phone'])){
                    return redirect()->to(base_url('landing')); exit;                         
                }else{
                    return redirect()->to(base_url('login')); exit;                
                }

            }else{   
                $this->session->setFlashdata("err_msg", "Phone number and password entered by you incorrect.");         
            } 
        }

    } catch (\Exception $e) {
        exit($e->getMessage());
    }
    return view('login/loginView2',$data);
}

public function signout()
{             
    $this->session->destroy();     
    return redirect()->to(base_url('login')); exit;          
} 


}
