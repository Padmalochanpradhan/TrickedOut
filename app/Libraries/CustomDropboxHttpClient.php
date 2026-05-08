<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use Kunnu\Dropbox\Http\Clients\DropboxGuzzleHttpClient;

class CustomDropboxHttpClient extends DropboxGuzzleHttpClient
{
    public function __construct()
    {
        // Inject Guzzle client with SSL verification disabled
        $guzzleClient = new Client([
            'verify' => false // Disable SSL verification
        ]);

        parent::__construct($guzzleClient);
    }
}
