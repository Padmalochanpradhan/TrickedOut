<?php

namespace App\Libraries;

use GuzzleHttp\Client;

class DropboxTokenManager
{
    protected $tokenFile;

    public function __construct()
    {
        $this->tokenFile = WRITEPATH . 'dropbox_tokens.json';
    }

    public function getAccessToken()
    {
        if (!file_exists($this->tokenFile)) {
            throw new \Exception("Dropbox token file not found.");
        }

        $tokens = json_decode(file_get_contents($this->tokenFile), true);
//exit;
        if (time() >= $tokens['token_expires_at']) {
            //print_r($tokens);exit;
            $client = new Client([
                'verify' => false // Only for development
            ]);

            $response = $client->post('https://api.dropbox.com/oauth2/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $tokens['refresh_token'],
                    'client_id' => getenv('DROPBOX_APP_KEY'),
                    'client_secret' => getenv('DROPBOX_APP_SECRET'),
                ]
            ]);

            $newTokens = json_decode($response->getBody(), true);

            $tokens['access_token'] = $newTokens['access_token'];
            $tokens['expires_in'] = $newTokens['expires_in'];
            $tokens['token_expires_at'] = time() + $newTokens['expires_in'];

            file_put_contents($this->tokenFile, json_encode($tokens, JSON_PRETTY_PRINT));
        }

        return $tokens['access_token'];
    }
}
