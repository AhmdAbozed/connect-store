<?php

namespace App\Services;

use App\Models\Channel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http as Http;

use function Laravel\Prompts\error;

class BackBlazeService
{
    private function getAuthorizationBody()
    {
        $blazeKey = config('backblaze.blaze_key');
        $blazeKeyId = config('backblaze.blaze_key_id');
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($blazeKeyId . ':' . $blazeKey)
        ])->retry(3, 100)->get('https://api.backblazeb2.com/b2api/v3/b2_authorize_account');
        return $response->json();
    }

    private function getUploadUrl(string $authorizationToken, string $apiUrl)
    {

        error_log('getting uploadUrl');
        $bucketId = config('backblaze.blaze_bucket_id');
        $response = Http::withHeaders([
            'Authorization' => $authorizationToken
        ])->get($apiUrl . '/b2api/v3/b2_get_upload_url?bucketId=' . $bucketId);

        error_log('gotten');
        return $response->json();
    }
    private function getFileIds(string $authorizationToken, string $apiUrl, string $fileName)
    {

        error_log('getting fileIds, '.$fileName);
        $bucketId = config('backblaze.blaze_bucket_id');
        $response = Http::withHeaders([
            'Authorization' => $authorizationToken
        ])->get($apiUrl . '/b2api/v3/b2_list_file_names?bucketId=' . $bucketId . '&prefix='.$fileName);

        $files = $response->json();
        error_log('gotten '.json_encode($files));
        // Initialize an array to hold the file IDs
        $fileIds = [];

        // Check if 'files' key exists and is an array
        if (isset($files['files']) && is_array($files['files'])) {
            // Iterate over each file and extract the 'fileId'
            foreach ($files['files'] as $file) {
                if (isset($file['fileId'])) {
                    $fileIds[] = $file['fileId'];
                }
            }
        }
        error_log(json_encode($fileIds));
        return $fileIds;
    }
    public function deleteFiles(string $fileName)
    {
        
        $bucketId = config('backblaze.blaze_bucket_id');
        $authorizationBody = $this->getAuthorizationBody();
        $fileIds = $this->getFileIds($authorizationBody['authorizationToken'], $authorizationBody['apiInfo']['storageApi']['apiUrl'], $fileName);
        foreach ($fileIds as $index => $fileId) {

            error_log('deleting files');
            $response = Http::withHeaders([
                'Authorization' => $authorizationBody['authorizationToken']
            ])->post($authorizationBody['apiInfo']['storageApi']['apiUrl'] . '/b2api/v3/b2_delete_file_version?bucketId=' . $bucketId, [
                'fileName'=>$fileName.'/'.$index,
                'fileId'=>$fileId
            ]);


            error_log(json_encode($response));
            error_log(json_encode($response->body()));
     
        }
    }
    ///b2api/v3/b2_list_file_names
    private function uploadFileHttp($uploadUrlBody, UploadedFile $filePath,  $imgId, $index)
    {
        $response = Http::withHeaders([
            //'Content-Type' in withHeaders is completely ignored on post
            'Authorization' => $uploadUrlBody['authorizationToken'],
            'X-Bz-File-Name' => urlencode('product/' . mb_convert_encoding($imgId, 'UTF-8', 'ISO-8859-1') . '/' . $index),
            'Content-Length' => File::size($filePath),
            'X-Bz-Content-Sha1' => sha1_file($filePath)
        ])->withBody(File::get($filePath))->contentType('b2/x-auto')->post($uploadUrlBody['uploadUrl']);
        return $response;
    }
    public function uploadFiles(array $filePaths, $imgId)
    {
        error_log(json_encode($filePaths[0]));
        $authorizationBody = $this->getAuthorizationBody();
        error_log(json_encode($authorizationBody));
        $uploadUrlBody = $this->getUploadUrl($authorizationBody['authorizationToken'], $authorizationBody['apiInfo']['storageApi']['apiUrl']);
        $retryFiles = [];
        foreach ($filePaths as $index => $filePath) {
            $response = $this->uploadFileHttp($uploadUrlBody, $filePath, $imgId, $index);
            error_log(json_encode($response));
            error_log('file #' . $index . ' ', json_encode($response->status()));
            if (!$response->successful()) {
                error_log('failed');
                array_push($retryFiles, $filePath);
            }
        }
        //sometimes bb is busy, retrying helps but may need more retries, also frontend isnt told if images arent uploaded
        foreach ($retryFiles as $index => $filePath) {
            error_log('retrying failed ones');
            $response = $this->uploadFileHttp($uploadUrlBody, $filePath, $imgId, $index);
        }
        return $response->json('fileId');
    }

    public function getAuthorizationToken()
    {
        error_log('getting authtoken');
        $authorizationBody = $this->getAuthorizationBody();
        error_log('gotten');

        return (object)['authorizationToken' => $authorizationBody['authorizationToken'], 'apiUrl' => $authorizationBody['apiInfo']['storageApi']['apiUrl']];
    }
}
