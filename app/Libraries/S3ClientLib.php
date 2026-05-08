<?php

namespace App\Libraries;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Aws\S3\MultipartUploader;

class S3ClientLib
{
    protected $s3;
    protected $bucket;

    public function __construct($config)
    {
        $this->bucket = $config['aws_bucket'];

        $this->s3 = new S3Client([
            'version' => 'latest',
            'region' => $config['aws_region'],
            'credentials' => [
                'key' => $config['aws_access_key'],
                'secret' => $config['aws_secret_key'],
            ],
    'http' => [
        'suppress_php_deprecation_warning' => true,
    ],
        ]);
    }

    public function uploadFile($filePath, $fileName)
    {
        try {
            $result = $this->s3->putObject([
                'Bucket' => $this->bucket,
                'Key' => $fileName,
                'SourceFile' => $filePath,
                //'ACL' => 'public-read', // Adjust as necessary
            ]);
            return $result['ObjectURL']; // Return the URL of the uploaded file
        } catch (S3Exception $e) {
            return $e->getMessage();
        }
    }
}
