<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps 
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

/*
 Login & signout 
*/
$routes->get('/', 'HomeController::landing');
$routes->post('newsletter', 'HomeController::landing');
$routes->post('contactUs', 'HomeController::contactUs');

$routes->get('SignUpSubscription', 'SignUpSubscriptionController::SignUpSubscription');
$routes->get('SignUpSubscription2', 'SignUpSubscriptionControllerTest::SignUpSubscription');


$routes->get('login', 'CommonController::login'); 
$routes->post('login', 'CommonController::login');
$routes->get('login2', 'CommonController::login2'); 
$routes->post('login2', 'CommonController::login2');
$routes->get('dashboard/signout', 'CommonController::signout');
$routes->get('signup', 'CommonController::signup'); 
$routes->post('signup', 'CommonController::signup');
$routes->get('forgot_password', 'CommonController::forgot_password'); 
$routes->post('forgot_password', 'CommonController::forgot_password');
$routes->get('resetpassword/(:segment)', 'CommonController::resetpassword/$1'); 
$routes->post('resetpassword_submit', 'CommonController::resetpassword_submit');

$routes->get('signup_one_page', 'CommonController::signup_without_otp');
$routes->post('signup_one_page', 'CommonController::signup_without_otp');
$routes->get('verify-otp', 'CommonController::verifyOtp');
$routes->post('verify-otp', 'CommonController::verifyOtp');
$routes->post('verifyOtp', 'CommonController::verifyOtp');
$routes->get('resend_otp', 'CommonController::resendOtp');

$routes->get('verify-phone', 'CommonController::verifyPhone');
$routes->post('verify-phone', 'CommonController::verifyPhone');
$routes->post('verifyPhone', 'CommonController::verifyPhone');
//$routes->get('resend_otp', 'CommonController::resendOtp');
  
$routes->post('verify-user', 'CommonController::verifyUser');
$routes->post('verify-user-otp', 'CommonController::verifyUserOtp');

/*
 Landing page  verifyPhone
 */
$routes->match(['get', 'post'], 'landing', 'DashboardController::landing');
/*
 manage Search Support
*/
$routes->post('Search', 'SearchController::Search'); 
$routes->get('Search', 'SearchController::Search');


$routes->post('Support', 'SupportController::Support'); 
$routes->get('Support', 'SupportController::Support');
/*
 manage vehicles
*/
$routes->post('MyVault', 'MyVaultController::MyVault'); 
$routes->get('MyVault', 'MyVaultController::MyVault');
$routes->get('FAQ', 'FAQController::FAQ');
/*
Mamage Subscription
*/
$routes->post('Subscription', 'SubscriptionController::Subscription'); 
$routes->get('Subscription', 'SubscriptionController::Subscription');
$routes->post('payment_submit', 'SubscriptionController::payment_submit');
$routes->post('subscriptionUpgrade', 'SubscriptionController::subscriptionUpgrade'); 
$routes->get('subscriptionUpgrade', 'SubscriptionController::Subscription'); 
$routes->get('subscription_alert', 'SubscriptionController::subscription_alert');
/*
Stripe 
*/ 
$routes->get('stripe/checkout', 'StripeController::createCheckoutSession');
$routes->post('stripe/checkout', 'StripeController::createCheckoutSession');
$routes->get('stripe/success', 'StripeController::success');
$routes->get('stripe/cancel', 'StripeController::cancel');
$routes->post('upgradeSubscriptionCheckout', 'StripeController::upgradeSubscriptionCheckout');
$routes->post('cancel_subscription', 'StripeController::cancelSubscription');
$routes->post('stripe/webhook', 'StripeWebhook::handle');

$routes->post('validate-coupon', 'StripeController::validate_coupon');

$routes->post('get-subscription-plans', 'CommonController::getSubscriptionPlans');
/*
 Manage User Own Category  validate-coupon
*/
$routes->get('Category', 'ManageCategory::Category'); 
$routes->post('addupdate_category', 'ManageCategory::addupdate_category'); 

 /*
 Manage Trick  
*/
$routes->get('UploadTrick', 'ManageTricks::UploadTrick'); 
$routes->get('UploadTrickMultiple', 'ManageTricks::UploadTrickMultiple');
$routes->post('UploadTrick', 'ManageTricks::UploadTrick'); 
$routes->get('UploadTrick/added', 'ManageTricks::UploadTrick'); 
$routes->post('UploadTrickSubmit', 'ManageTricks::UploadTrickSubmit');
$routes->post('UploadTrickMultiple', 'ManageTricks::UploadTrickMultiple');

$routes->get('DropboxUploadTest', 'DropboxUploadController::uploadToDropbox'); 

$routes->get('DropboxViewTest', 'DropboxUploadController::viewToDropbox');

$routes->post('uploadToDropbox', 'DropboxUploadController::uploadToDropbox'); 
$routes->get('uploadToDropbox', 'DropboxUploadController::uploadToDropbox'); 
$routes->get('dropbox/uploadLarge', 'DropboxController::uploadLarge');
$routes->get('dropbox/upload', 'DropboxController::upload');
$routes->get('dropbox/download', 'DropboxController::download');
$routes->get('dropbox/delete', 'DropboxController::delete');
$routes->get('getaccessToken', 'DropboxUploadController::getaccessToken'); 

$routes->get('getDirectLink/(:any)', 'DropboxUploadController::getDirectLink/$1');
$routes->post('deleteFileFromDropbox', 'DropboxUploadController::deleteFileFromDropbox');

$routes->get('dropboxauthcallback', 'DropboxUploadController::authCallback');
$routes->get('dropboxconnect', 'DropboxController::connect');

$routes->post('BackstageUploadTrickSubmit', 'ManageTricks::BackstageUploadTrickSubmit');
$routes->get('CategoryTricks/(:segment)', 'ManageTricks::CategoryTricks/$1'); 
$routes->get('UploadTrickStart', 'ManageTricks::UploadTrickStart'); 
$routes->post('UploadTrickStart', 'ManageTricks::UploadTrickStart'); 
$routes->get('UploadTrickProcess/(:segment)', 'ManageTricks::UploadTrickProcess/$1'); 
$routes->get('UploadTrickProcess', 'ManageTricks::UploadTrickProcess'); 
$routes->post('UploadTrickProcess', 'ManageTricks::UploadTrickProcess'); 
$routes->get('UploadTrickComplete', 'ManageTricks::UploadTrickComplete'); 
$routes->get('UploadTrickComplete/(:segment)', 'ManageTricks::UploadTrickComplete/$1'); 
$routes->post('UploadTrickComplete', 'ManageTricks::UploadTrickComplete'); 
$routes->get('TrickBackstage', 'ManageTricks::TrickBackstage'); 
$routes->post('TrickBackstage', 'ManageTricks::TrickBackstage'); 
$routes->post('saveBackStageVideoProgress', 'ManageTricks::saveBackStageVideoProgress'); 



$routes->get('TricksDetails/(:segment)/(:segment)', 'ManageTricks::TricksDetails/$1/$1');
$routes->post('saveVideoNote', 'ManageTricks::saveVideoNote'); 
 $routes->post('getVideoNote', 'ManageTricks::getVideoNote'); 
$routes->post('getTrickDetails', 'ManageTricks::getTrickDetails'); 
$routes->post('saveVideoProgress', 'ManageTricks::saveVideoProgress'); 
$routes->get('TricksDetails/(:segment)', 'ManageTricks::TricksDetails/$1'); 
$routes->post('TrickFieldUpdate', 'ManageTricks::TrickFieldUpdate'); 
$routes->POST('GetSupplierByName', 'ManageTricks::GetSupplierByName'); 
$routes->POST('AddSupplier', 'ManageTricks::AddSupplier'); 
$routes->POST('get_master_desc', 'ManageTricks::get_master_desc'); 
$routes->POST('uploadFileBySplit', 'ManageTricks::uploadFileBySplit'); 
$routes->POST('uploadMultipleFileBySplitTemp', 'ManageTricks::uploadMultipleFileBySplitTemp'); 

$routes->POST('insertLogAPI', 'ManageTricks::insertLogAPI'); 
/*
 Manage Bug 
*/
$routes->get('Bug', 'ManageBug::ManageBug'); 
$routes->get('Bug/(:segment)', 'ManageBug::ManageBug/$1'); 
$routes->post('Bug', 'ManageBug::ManageBug'); 
$routes->post('AddBugSubmit', 'ManageBug::AddBugSubmit');
$routes->get('s3Upload', 'S3Upload::upload_file_to_s3'); 
$routes->post('s3UploadSubmit', 'S3Upload::upload'); 
/*
Admin dashboard And data manage
*/
$routes->post('Dashboard', 'AdminDashboardController::Dashboard'); 
$routes->get('Dashboard', 'AdminDashboardController::Dashboard');

/*(:segment)

*/
$routes->get('appuploadeddocument', 'AppUploadedDocumentController::DocumentManage');  
$routes->post('appUploadDocumentlist', 'AppUploadedDocumentController::appUploadDocumentlist'); 
$routes->get('appUploadDocumentlist', 'AppUploadedDocumentController::appUploadDocumentlist'); 


/*
 Manage Document
*/
$routes->get('DocumentUpload', 'DocumentUploadController::DocumentUpload'); 
$routes->post('DocumentUpload', 'DocumentUploadController::DocumentUpload'); 
$routes->post('allattachment', 'DocumentUploadOutsideController::AllAttachment'); 
$routes->get('allattachment', 'DocumentUploadController::AllAttachment'); 
$routes->post('insertUploadedFilesInTable', 'DocumentUploadController::insertUploadedFilesInTable'); 


$routes->get('note', 'ReleaseNote::note'); 
$routes->post('note-update', 'ReleaseNote::note_update');
$routes->get('plan', 'ManagePlan::plan');
$routes->post('addupdate_plan', 'ManagePlan::addupdate_plan');

$routes->get('user', 'ManageUser::user'); 
$routes->post('user', 'ManageUser::user'); 

 // MyPerformance
$routes->get('MyPerformance', 'MyPerformanceController::MyPerformance'); 

$routes->post('PerformanceSubmit', 'MyPerformanceController::PerformanceSubmit'); 
$routes->get('MyPerformanceAdd', 'MyPerformanceController::MyPerformanceAdd'); 
$routes->get('MyPerformanceAdd/(:segment)', 'MyPerformanceController::MyPerformanceAdd/$1'); 
$routes->post('DeletePerformance', 'MyPerformanceController::DeletePerformance');
$routes->post('savePerformanceVideoProgress', 'MyPerformanceController::savePerformanceVideoProgress');
$routes->get('getPerformanceFileUrl/(:segment)', 'MyPerformanceController::getPerformanceFileUrl/$1');

// Organization
$routes->get('organization/(:segment)', 'Organization::index/$1');  
$routes->post('orgdetails', 'organization::details');
$routes->post('orgdetailssubmit', 'organization::orgdetailssubmit');
$routes->post('verify-email-in-organization', 'organization::verifyEmailInOrganization');
// 
$routes->get('(:segment)', 'Organization::index/$1');
//Costomer manage
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
