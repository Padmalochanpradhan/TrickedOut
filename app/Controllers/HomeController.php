<?php
/**
*  @category   User login
 * @package    Controller
 * @author     Padma
 * @copyright  2026 Karma
*/
namespace App\Controllers;
use App\Libraries\Mailer;
use App\Libraries\StripeService;

class HomeController extends BaseController
{       

    public function landing()
    {     
        try{
            
            $apidata = array(
                    "userId" => 0
                ); 
            $stripeService = new StripeService();
            $response = $stripeService->getStripeProductsWithPaymentLinks();
            $subscriptionList = $response['data'];
            //echo "<pre>";print_r($subscriptionList);exit;          
            $data = [
                'title'   => 'HOME :: '.PAGETITLE,
                'pageHeading' => 'HOME',
                'subscriptions' => $subscriptionList 
            ]; 
            if ($this->request->getMethod() === 'post') {
                //echo "<pre>";print_r($_POST);exit; 
                $name = $this->request->getVar('name');
                $email = $this->request->getVar('email');
                if($name && $email){
                    $referer = $this->request->getServer('HTTP_REFERER');
                    //echo $referer."::".base_url();exit;
                    if (!$referer || strpos($referer, base_url()) !== 0) {
                        exit('Invalid request source');
                    }
                    if ($this->request->getPost('form_token') !== session()->get('form_token')) {
                        exit('Invalid token');
                    }
                    $token = $this->request->getPost('recaptcha_token2');

                    $secret = "6Ld8OW0sAAAAAOphwADKizPn99dBzzpThqt6k8B9";

                    $response = file_get_contents(
                        "https://www.google.com/recaptcha/api/siteverify?secret="
                        .$secret."&response=".$token
                    );

                    $result = json_decode($response);
        //echo "<pre>";print_r($_POST);
                    if (!$result->success || $result->score < 0.5) {
                        exit('Spam detected');
                    } 
                    $email = trim($email);
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        return redirect()->to('/')
                            ->with('error', '⚠️ Please enter a valid email address.');
                    }
                    $body = '<table width="90%" border="0" cellspacing="5" cellpadding="5" style="font-family: Arial, sans-serif; font-size: 14px; color: #333;">
                            <tr>
                                <td>
                                    <img src="'.base_url().'/assets/images/tricked_logo1.png" style="width:250px;" alt="Tricked Out Logo">
                                </td>
                            </tr>

                            <tr>
                                <td>Hello Admin,</td>
                            </tr>

                            <tr>
                                <td>
                                    A new user has successfully subscribed to the <strong>Tricked Out Newsletter</strong>.
                                </td>
                            </tr>

                            <tr>
                                <td >
                                    <strong>Subscriber Details:</strong>
                                </td>
                            </tr>

                            <tr>
                                <td style="font-size:16px; font-weight:bold; padding:10px 0;">
                                    Name: '.$name.'
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:16px; font-weight:bold; padding:10px 0;">
                                    Email: '.$email.'
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Subscription Date: <strong>'.date("d M Y, h:i A").'</strong>
                                </td>
                            </tr>

                            

                            <tr>
                                <td style="padding-top:15px;">
                                    Thanks,<br>
                                    <strong>Tricked Out System</strong>
                                </td>
                            </tr>
                        </table>';
                    $mailer = new Mailer();
                    $to = 'pradhan.padma@gmail.com';
                    //$to = $email;
                    $subject = 'Tricked Out - Newsletter Subscription';  
                    $mail = $mailer->sendMail($to, $subject, $body);
                    //echo "<pre>";print_r($mail);exit;
                    if ($mail) {
                        return redirect()->to('/')
                            ->with('success', '🎉 Thank you for subscribing! You have been successfully added to our newsletter.');
                    } else {
                        return redirect()->to('/')
                            ->with('error', '⚠️ Something went wrong. Please try again later.');
                    }
                }
            }    
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
        session()->set('form_token', bin2hex(random_bytes(32)));
        return view('landing/landingView',$data);
    } 
    public function contactUs()
    {     
        try{
            //echo "<pre>";print_r($_POST);exit;




            $referer = $this->request->getServer('HTTP_REFERER');
            //echo $referer."::".base_url();exit;
            if (!$referer || strpos($referer, base_url()) !== 0) {
                exit('Invalid request source');
            }
            $otp = $this->request->getPost('otp');
            if($otp){
            if($otp == session()->get('contact_otp'))
            {
                // success
                $contactData = session()->get('contact_data');
               $name = $contactData['name'];
               $email = $contactData['email'];
               $contact_phone = $contactData['contact_phone'];
               $message = $contactData['message'];
                $body = '
                <table width="90%" border="0" cellspacing="5" cellpadding="5"
                       style="font-family: Arial, sans-serif; font-size:14px; color:#333;">
                    
                    <tr>
                        <td>
                            <img src="'.base_url().'/assets/images/tricked_logo1.png"
                                 style="width:250px;" alt="Tricked Out Logo">
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
                $to = 'pradhan.padma@gmail.com';
                $subject = 'Tricked Out - Support Inquiry - '.$name;
                $bcc     = 'pradhan.padma@gmail.com';  
                session()->remove('contact_otp');
                session()->remove('contact_data');
                if ($mailer->sendMail($to, $subject, $body, $bcc)) {
                    return redirect()->back()
                        ->with('success', 'Thank you! Your message has been sent to our support team.');
                } else {
                    return redirect()->back()
                        ->with('error', 'Sorry, something went wrong. Please try again later.');
                }





            }else{
                return redirect()->back()
                    ->with('showOtpPopup', true)
                    ->with('error', 'Invalid OTP. Please try again.'); 
            }
        }
            if ($this->request->getPost('form_token') !== session()->get('form_token')) {
                exit('Invalid token');
            }
            $token = $this->request->getPost('recaptcha_token');

            $secret = "6Ld8OW0sAAAAAOphwADKizPn99dBzzpThqt6k8B9";

            $response = file_get_contents(
                "https://www.google.com/recaptcha/api/siteverify?secret="
                .$secret."&response=".$token
            );

            $result = json_decode($response);
//echo "<pre>";print_r($_POST);
            if (!$result->success || $result->score < 0.5) {
                exit('Spam detected');
            }
             //echo "<pre>";print_r($result); 
            //exit; 
            if($_POST){                  
               //echo "<pre>";print_r($_POST);exit;
               $name = $_POST['name'];
               $email = $_POST['email'];
               $contact_phone = $_POST['contact_phone'];
               $message = $_POST['message'];
                // ✅ Generate OTP
                $otp = rand(100000, 999999);
                //$otp = 123456;

                // ✅ Save in session
                session()->set('contact_otp', $otp);
                session()->set('contact_data', [
                    'name' => $name,
                    'email' => $email,
                    'contact_phone' => $contact_phone,
                    'message' => $message
                ]);


                $body = '
                <table width="90%" border="0" cellspacing="5" cellpadding="5"
                       style="font-family: Arial, sans-serif; font-size:14px; color:#333;">
                    
                    <tr>
                        <td>
                            <img src="'.base_url().'/assets/images/tricked_logo1.png"
                                 style="width:250px;" alt="Tricked Out Logo">
                        </td>
                    </tr>

                    <tr>
                        <td>Hello '.$name.',</td>
                    </tr>

                    <tr>
                        <td>
                            Your OTP for Contact Verification is: 
                            <strong>'.$otp.'</strong> website.
                        </td>
                    </tr>

                    <tr>
                        <td>
                            This OTP is valid for 5 minutes.
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
                $to = $email;
                $subject = 'Tricked Out - Contact OTP';
                $bcc     = 'pradhan.padma@gmail.com';  
                if ($mailer->sendMail($to, $subject, $body, $bcc)) {
                    return redirect()->back()->with('showOtpPopup', true);
                } else {

                    return redirect()->back()->with('showOtpPopup', true);
                    // return redirect()->back()
                    //     ->with('error', 'Sorry, something went wrong. Please try again later.');
                }
                

            }                     
            
                
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
        //return view('landing/landingView',$data);
    } 


   
}
