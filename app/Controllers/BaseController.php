<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Psr\Log\LoggerInterface;
use App\Libraries\Mycurl;
use App\Libraries\FileUpload;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form','url'];
    protected $url;
    protected $session;
    protected $curl;
    protected $upload;
    
    

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);       

        // Preload any models, libraries, etc, here.

        $this->session = \Config\Services::session();
        $this->curl = new Mycurl(); 
        $this->upload = new FileUpload(); 
    }
    public function functionAccessSecurityCheck($functionCode){
        $userSecurity = $_SESSION['function_security'];
        foreach($userSecurity as $security){
            if($security->code==$functionCode){
                return true;
            }
        }
        return false;
    }
    public function insertActivateLog($log_type_id,$log_type,$log_details,$log_title=""){
        $insertDataArray1 = array();
        $insertData1 = array(
            "log_type" => $log_type,
            "log_title" => $log_title,
            "log_details" => $log_details,
            "log_type_id" => $log_type_id,
            "added_by" => $_SESSION['employee_id']
        );
        array_push($insertDataArray1,$insertData1);        
        $apidata = array(
            "table_name" => "activity_log",
            "insertDataArray" => $insertDataArray1,
        );
        $this->curl->curl_call(APIURL.'TrickedOutInsertMultipleRows',$apidata);
    }
}
