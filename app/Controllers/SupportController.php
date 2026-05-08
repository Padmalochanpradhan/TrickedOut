<?php

namespace App\Controllers;
use App\Libraries\Mailer;
class SupportController extends BaseController
{ 

    public function Support()
    {

        if(!$this->session->get('loggedIn')) {
             //return redirect()->to(base_url('login')); exit;     
        }

        if($_POST){                  
              // echo "<pre>";print_r($_POST);exit;
               $name = $_POST['name'];
               $email = $_POST['email'];
               $contact_phone = $_POST['contact_phone'];
               $message = $_POST['message'];
                $body = '
                <table width="90%" border="0" cellspacing="5" cellpadding="5"
                       style="font-family: Arial, sans-serif; font-size:14px; color:#333;">
                    
                    <tr>
                        <td>
                            <img src="'.base_url().'/assets/images/tricked_logo1.png"
                                 style="width:60%;" alt="Tricked Out Logo">
                        </td>
                    </tr>

                    <tr>
                        <td>Hello Support Team,</td>
                    </tr>

                    <tr>
                        <td>
                            A new support request has been submitted through the
                            <strong>Tricked Out</strong> website.
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table width="100%" border="0" cellpadding="6" cellspacing="0"
                                   style="border:1px solid #ddd; border-collapse:collapse;">
                                
                                <tr>
                                    <td style="font-weight:bold; width:30%;">Name</td>
                                    <td>'.$name.'</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;">Email</td>
                                    <td>'.$email.'</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold;">Contact Phone</td>
                                    <td>'.$contact_phone.'</td>
                                </tr>

                                <tr>
                                    <td style="font-weight:bold; vertical-align:top;">Message</td>
                                    <td>'.nl2br($message).'</td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Submitted on: <strong>'.date("d M Y, h:i A").'</strong>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Please respond to the user at the earliest convenience.
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Thanks,<br>
                            <strong>The Tricked Out System</strong>
                        </td>
                    </tr>

                </table>';

                $mailer = new Mailer();
                //$to = 'bamadebupadhya@gmail.com';
                $to = 'info@trickedoutmagic.com';
                $subject = 'Tricked Out - Support Inquiry - '.$name;
                $bcc     = 'pradhan.padma@gmail.com';  
                if ($mailer->sendMail($to, $subject, $body, $bcc)) {
                    return redirect()->back()
                        ->with('success_msg', 'Thank you! Your message has been sent to our support team.');
                } else {
                    return redirect()->back()
                        ->with('err_msg', 'Sorry, something went wrong. Please try again later.');
                }

        }
           
        $actionList = array();

        $data = [
            'title'   => 'SUBSCRIPTION :: '.PAGETITLE,
            
            //'subscriptionList' => $subscriptionList->data,
            //'currentSubscriptionDetails' => $currentSubscriptionDetails->data,
            'pageHeading' => 'MY VAULT'
        ]; 
        
        return view('templates/header',$data)
              .view('templates/left_menu',$data)
              .view('support/SupportView',$data)
              .view('templates/footer_blank',$data);
    }
  
}
