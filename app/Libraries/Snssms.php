<?php

namespace App\Libraries;

use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;


class Snssms
{
    // This function converts a string into slug format
    public function sendOtpSms($phoneNumber, $otp)
    {
        $sns = new SnsClient([
            'region' => 'us-east-1', // India region
            'version' => '2010-03-31',
            'credentials' => [
                'key' => getenv('AWS_SNS_ACCESS_KEY'),
                'secret' => getenv('AWS_SNS_SECRET_KEY'),
            ]
        ]);

        $message = "Your OTP is: {$otp}";

        try {
            $result = $sns->publish([
                'Message'     => $message,
                'PhoneNumber'=> '+91' . $phoneNumber
            ]);
            //return $result['MessageId'];
            return $result;
        } catch (AwsException $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }
}