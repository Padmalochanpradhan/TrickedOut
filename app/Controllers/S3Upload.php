<?php

namespace App\Controllers;

use App\Libraries\S3ClientLib; // Make sure this matches the location of your S3 library

class S3Upload extends BaseController
{
    protected $s3clientlib;

    public function __construct()
    {
        // Directly instantiate the S3ClientLib
                $config = [
            'aws_access_key' => getenv('AWS_S3_ACCESS_KEY'),
            'aws_secret_key' => getenv('AWS_S3_SECRET_KEY'),
            'aws_region' => "us-west-2",
            'aws_bucket' => "supersalesblitz",
        ];
        $this->s3clientlib = new S3ClientLib($config);
    }

    public function upload_file_to_s3()
    {
        $data = [
            'title' => 'SUBMIT BUG :: ' . PAGETITLE,
            'pageHeading' => 'SUBMIT BUG'
        ];

        return view('templates/header', $data)
            . view('templates/left_menu', $data)
            . view('bug/upload_file_to_s3View', $data)
            . view('templates/footer', $data);
    }

    public function upload()
    {
        // Assuming you have a form to upload files and it’s named 'userfile'
        $file = $this->request->getFile('userfile');  // CodeIgniter 4 way of getting files from request

        if ($file->isValid() && !$file->hasMoved()) {
            $filePath = $file->getTempName();
            $fileName = $file->getName();

            $uploadUrl = $this->s3clientlib->uploadFile($filePath, $fileName);

            if (filter_var($uploadUrl, FILTER_VALIDATE_URL)) {
                echo "File uploaded successfully: " . $uploadUrl;
            } else {
                echo "File upload failed: " . $uploadUrl;
            }
        } else {
            echo "File is invalid or has already been moved.";
        }
    }
}
