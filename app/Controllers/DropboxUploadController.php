<?php

namespace App\Controllers;
use App\Libraries\DropboxClient;

class DropboxUploadController extends BaseController
{
    /*public function uploadToDropbox()
    {
        //return "ABC";
         try {
        $file = $this->request->getFile('chunk');
        $filename = $this->request->getPost('filename');
        $currentChunk = $this->request->getPost('currentChunk');
        $totalChunks = $this->request->getPost('totalChunks');

        if (!$file->isValid()) {
            return $this->response->setJSON(['success' => false, 'error' => 'Invalid chunk']);
        }

        $uploader = new DropboxClient();
        $result = $uploader->uploadChunk($file, $filename, $currentChunk, $totalChunks);
//return $filename;
        return $this->response->setJSON($result);
    } catch (\Throwable $e) {
        return $this->response->setJSON([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
    }*/
    // public function uploadToDropbox()
    // {
    //     $file = $this->request->getFile('file');
    //     $fileName = $this->request->getPost('filename');
    //     $session_id = $this->request->getPost('session_id');

    //     if ($file && $file->isValid() && !$file->hasMoved()) {
    //         $tempPath = WRITEPATH . 'uploads/' . $fileName;
    //         $file->move(WRITEPATH . 'uploads', $fileName);

    //         $dropboxClient = new \App\Libraries\DropboxClient();
    //         //$dropboxPath = '/uploads/' . $fileName;
    //         // Break fileName into name and extension
    //         $nameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
    //         $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    //         // New dropbox path with session_id inserted
    //         $dropboxFileName = $nameWithoutExt . '_' . $session_id . '.' . $extension;
    //         $dropboxPath = '/uploads/' . $dropboxFileName;
    //         try {
    //             $dropboxClient->uploadLargeFile($tempPath, $dropboxPath);
    //             unlink($tempPath);
    //             return $this->response->setJSON(['success' => true, 'fileName' => $fileName,'uploadFileName' => $dropboxFileName]);
    //         } catch (\Exception $e) {
    //             return $this->response->setJSON(['success' => false, 'error' => $e->getMessage()]);
    //         }
    //     }

    //     return $this->response->setJSON(['success' => false, 'error' => 'Invalid file']);
    // }
    public function uploadToDropbox()
    {
        $file = $this->request->getFile('file');
        $fileName = $this->request->getPost('filename');
        $session_id = $this->request->getPost('session_id');

        if ($file === null) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'File not received (blocked by server)'
            ]);
        }

        if (! $file->isValid() || $file->hasMoved()) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $file->getErrorString()
            ]);
        }

        $tempPath = WRITEPATH . 'uploads/' . $fileName;
        $file->move(WRITEPATH . 'uploads', $fileName);

        $nameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $dropboxFileName = $nameWithoutExt . '_' . $session_id . '.' . $extension;
        $dropboxPath = '/uploads/' . $dropboxFileName;

        try {
            $dropboxClient = new \App\Libraries\DropboxClient();
            $dropboxClient->uploadLargeFile($tempPath, $dropboxPath);

            unlink($tempPath);

            return $this->response->setJSON([
                'success' => true,
                'uploadFileName' => $dropboxFileName,
                'fileName' => $fileName
            ]);

        } catch (\Throwable $e) {
            log_message('error', $e->getMessage());

            return $this->response->setJSON([
                'success' => false,
                'error' => 'Dropbox upload failed'
            ]);
        }
    }
    
    public function getDirectLink($fileName){
        $dropboxClient = new \App\Libraries\DropboxClient();
        try {
            //$dropboxPath = '/uploads/'.$fileName;
            $directLink = $dropboxClient->getDirectLink("sample (1).pdf");
            //unlink($tempPath);
            echo $directLink;
            //return $directLink;
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'error' => $e->getMessage()]);
        }
  
    }
    public function deleteFileFromDropbox(){
        $dropboxClient = new \App\Libraries\DropboxClient();
        try {
        $filePath = $this->request->getPost('filePath');
            //$dropboxPath = '/uploads/'.$fileName;
            $result = $dropboxClient->delete($filePath);
            //unlink($tempPath);
            //echo $directLink;
            return $result;
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'error' => $e->getMessage()]);
        }

    }
        public function authCallback(){
        $code = $this->request->getGet('code');
        //echo $code;exit;
        //$code = "-GE_4fUv43AAAAAAAAABCCNpg5Qb7DLBrkplrxI1pJ8";
        //$client = new \GuzzleHttp\Client();
        $client = new \GuzzleHttp\Client([
            'verify' => false //  Dev only
        ]);
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
        //echo "<pre>";print_r($tokens);exit;
        // Add calculated expiry time
        $tokens['token_expires_at'] = time() + $tokens['expires_in'];

        // Save tokens to a file
        $tokenFile = WRITEPATH . 'dropbox_tokens.json';
        file_put_contents($tokenFile, json_encode($tokens, JSON_PRETTY_PRINT));

        return "Dropbox access token saved!";/**/

    }

}
