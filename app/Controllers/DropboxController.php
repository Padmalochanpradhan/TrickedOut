<?php

namespace App\Controllers;

use App\Libraries\DropboxClient;

class DropboxController extends BaseController
{
    public function upload()
    {
        $client = new DropboxClient();
        $localPath = "D:/TrickedOut/samplefile/Single Handed.mp4";
        $dropboxPath = '/uploads/s79997.mp4';

        //$result = $client->upload($localPath, $dropboxPath);
        try {
            $result = $client->upload($localPath, $dropboxPath);
            echo "<pre>"; print_r($result);
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function uploadLarge()
    {
        $client = new \App\Libraries\DropboxClient();

        //$localPath = WRITEPATH . 'uploads/very_large_file.zip';
        //$dropboxPath = '/CI4/very_large_file.zip';
        $localPath = "D:/movie/Chandu Champion (2024) {Hindi-Tamil-Telugu} 720p WEB-DL ESub [BollyFlix].mkv";
        $dropboxPath = '/uploads/Chunked79997.mkv';

        try {
            $result = $client->uploadLargeFile($localPath, $dropboxPath);
            echo "<pre>"; print_r($result);
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function download()
    {
        $client = new DropboxClient();
        $dropboxPath = '/CI4/sample.pdf';
        $localPath = WRITEPATH . 'downloads/sample_downloaded.pdf';

        $result = $client->download($dropboxPath, $localPath);
        return $this->response->download($result, null);
    }

    public function delete()
    {
        $client = new DropboxClient();
        $dropboxPath = '/CI4/sample.pdf';

        $result = $client->delete($dropboxPath);
        echo "<pre>";
        print_r($result);
    }
        public function authCallback(){
        //$code = $this->request->getGet('code');

        $code = "-GE_4fUv43AAAAAAAAABBTr8jfFJTWkAfGQTUHgfJPA";
        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://api.dropbox.com/oauth2/token', [
            'form_params' => [
                'code' => $code,
                'grant_type' => 'authorization_code',
                'client_id' => getenv('DROPBOX_APP_KEY'),
                'client_secret' => getenv('DROPBOX_APP_SECRET'),
                'redirect_uri' => getenv('DROPBOX_REDIRECT_URI'),
            ]
        ]);

        $tokens = json_decode($response->getBody(), true);

        // Add calculated expiry time
        $tokens['token_expires_at'] = time() + $tokens['expires_in'];

        // Save tokens to a file
        $tokenFile = WRITEPATH . 'dropbox_tokens.json';
        file_put_contents($tokenFile, json_encode($tokens, JSON_PRETTY_PRINT));

        return "Dropbox access token saved!";

    }
    public function connect()
    {
        $params = http_build_query([
            'client_id'     => getenv('DROPBOX_APP_KEY'),
            'response_type' => 'code',
            'redirect_uri'  => getenv('DROPBOX_REDIRECT_URI'),
            'token_access_type' => 'offline' // IMPORTANT (for refresh token)
        ]);

        return redirect()->to("https://www.dropbox.com/oauth2/authorize?$params");
    }
}
