<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected Client $client;
    protected string $from;

    public function __construct()
    {
        $this->client = new Client(
            getenv('TWILIO_SID'),
            getenv('TWILIO_TOKEN')
        );

        $this->from = getenv('TWILIO_FROM');
    }

public function sendSMS(string $to, string $message): array
{
    try {
        $result = $this->client->messages->create(
            $to,
            [
                'from' => $this->from,
                'body' => $message
            ]
        );

        return [
            'success'    => true,
            'sid'        => $result->sid,
            'status'     => $result->status,
            'to'         => $result->to,
            'from'       => $result->from,
            'error_code' => $result->errorCode,
            'error_msg'  => $result->errorMessage,
        ];

    } catch (\Twilio\Exceptions\RestException $e) {
        return [
            'success'    => false,
            'status'     => 'failed',
            'error_code' => $e->getCode(),
            'error_msg'  => $e->getMessage(),
            'more_info'  => $e->getMoreInfo()
        ];
    } catch (\Exception $e) {
        log_message('error', 'Twilio Error: ' . $e->getMessage());

        return [
            'success'   => false,
            'status'    => 'failed',
            'error_msg' => $e->getMessage()
        ];
    }
}

}
