<?php

namespace App\Libraries;

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use GuzzleHttp\Client as GuzzleClient;
use Kunnu\Dropbox\Http\Clients\DropboxGuzzleHttpClient;
use App\Libraries\DropboxTokenManager;
class DropboxClient
{
    protected $dropbox;
    protected $sessionPath;
    public function __construct()
    {
        //$app = new DropboxApp("00a4a28bzqs7unx", "m924zxle6scf9gv", getAccessTokenFromFile());
        $tokenManager = new DropboxTokenManager();
        $accessToken = $tokenManager->getAccessToken();

        $app = new DropboxApp(
            getenv('DROPBOX_APP_KEY'),
            getenv('DROPBOX_APP_SECRET'),
            $accessToken
        );
        //  Create custom Guzzle client with SSL verification disabled
        $guzzleClient = new GuzzleClient([
            'verify' => false //  Dev only
        ]);

        //  Wrap it in Dropbox's Guzzle client wrapper
        $dropboxHttpClient = new DropboxGuzzleHttpClient($guzzleClient);
       
        $config = [
        'http_client_handler' => $dropboxHttpClient
        ];           
        $this->dropbox = new Dropbox($app, $config);        
       // $this->dropbox = new Dropbox($app);
    }

    public function upload($localPath, $dropboxPath)
    {
        //echo $localPath; 
        $dropboxFile = new \Kunnu\Dropbox\DropboxFile($localPath);
        return $this->dropbox->upload($dropboxFile, $dropboxPath, ['autorename' => true]);
    }
public function uploadLargeFile($localPath, $dropboxPath)
{
    if (!file_exists($localPath)) {
        throw new \Exception("File does not exist: $localPath");
    }

    // Create DropboxFile instance
    $file = new \Kunnu\Dropbox\DropboxFile($localPath);

    // Get file size
    $fileSize = filesize($localPath);

    // Optional: chunk size (default is 8 MB = 8 * 1024 * 1024)
    $chunkSize = 8 * 1024 * 1024;

    // Optional upload params
    $uploadParams = [
        'autorename' => true,
        'mute' => false,
        'mode' => 'add'  // you can also use 'overwrite'
    ];

    // Call SDK method
    return $this->dropbox->uploadChunked($file, $dropboxPath, $fileSize, $chunkSize, $uploadParams);
}
    public function uploadChunk($chunkFile, $filename, $currentChunk, $totalChunks)
{
    $chunkData = file_get_contents($chunkFile->getTempName());
    $sessionFile = $this->sessionPath . md5($filename) . '.session';

    // If first chunk: start session
    if ($currentChunk == 0) {
        $response = $this->dropbox->postToContentDropboxAPI(
            '/upload_session/start',
            [],
            [
                'Dropbox-API-Arg' => json_encode(['close' => false]),
                'Content-Type' => 'application/octet-stream'
            ],
            $chunkData
        );

        $sessionId = json_decode($response->getBody(), true)['session_id'];
        file_put_contents($sessionFile, $sessionId);
    } else {
        $sessionId = file_get_contents($sessionFile);

        $cursor = [
            'session_id' => $sessionId,
            'offset' => $currentChunk * strlen($chunkData)
        ];

        if ($currentChunk == $totalChunks - 1) {
            // Final chunk
            $commit = [
                'path' => '/uploads/' . $filename,
                'mode' => 'add',
                'autorename' => true,
                'mute' => false
            ];

            $this->dropbox->postToContentDropboxAPI(
                '/upload_session/finish',
                [],
                [
                    'Dropbox-API-Arg' => json_encode([
                        'cursor' => $cursor,
                        'commit' => $commit
                    ]),
                    'Content-Type' => 'application/octet-stream'
                ],
                $chunkData
            );

            unlink($sessionFile); // Clean up
        } else {
            // Append chunk
            $this->dropbox->postToContentDropboxAPI(
                '/upload_session/append_v2',
                [],
                [
                    'Dropbox-API-Arg' => json_encode([
                        'cursor' => $cursor,
                        'close' => false
                    ]),
                    'Content-Type' => 'application/octet-stream'
                ],
                $chunkData
            );
        }
    }

    return ['success' => true, 'fileName' => $filename];
}

    public function download($dropboxPath, $saveTo)
    {
        $file = $this->dropbox->download($dropboxPath);
        file_put_contents($saveTo, $file->getContents());
        return $saveTo;
    }
    public function getDirectLink($filename)
    {
        $path = '/uploads/' . $filename;
        try {
            $response = $this->dropbox->getTemporaryLink($path);
            return $response->getLink();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getPerformanceFileLink($filename)
    {
        $path = '/performance_files/' . $filename;
        try {
            $response = $this->dropbox->getTemporaryLink($path);
            return $response->getLink();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function delete($dropboxPath)
    {
        return $this->dropbox->delete($dropboxPath);
    }

    public function listFolder($path = '')
    {
        return $this->dropbox->listFolder($path)->getItems();
    }
    public function getAccessTokenFromFile()
    {
        $tokenFile = WRITEPATH . 'dropbox_tokens.json';

        if (!file_exists($tokenFile)) {
            throw new \Exception("Dropbox token file not found.");
        }

        $tokens = json_decode(file_get_contents($tokenFile), true);

        // Refresh if expired
        if (time() >= $tokens['token_expires_at']) {
            $client = new \GuzzleHttp\Client();

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

            // Save updated token
            file_put_contents($tokenFile, json_encode($tokens, JSON_PRETTY_PRINT));
        }

        return $tokens['access_token'];
    }    
}
