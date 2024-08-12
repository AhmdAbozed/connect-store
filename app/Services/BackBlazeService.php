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
        ])->get('https://api.backblazeb2.com/b2api/v3/b2_authorize_account');
        return $response->json();
    }

    private function getUploadUrl(string $authorizationToken, string $apiUrl)
    {
        $bucketId = config('backblaze.blaze_bucket_id');
        $response = Http::withHeaders([
            'Authorization' => $authorizationToken
        ])->get($apiUrl . '/b2api/v3/b2_get_upload_url?bucketId=' . $bucketId);

        return $response->json();
    }

    private function uploadFileHttp($uploadUrlBody, $filePath,  $imgId, $index)
    {
        $response = Http::withHeaders([
            //'Content-Type' in withHeaders is completely ignored on post
            'Authorization' => $uploadUrlBody['authorizationToken'],
            'X-Bz-File-Name' => urlencode('product/' . mb_convert_encoding($index . $imgId, 'UTF-8', 'ISO-8859-1')),
            'Content-Length' => File::size($filePath),
            'X-Bz-Content-Sha1' => sha1_file($filePath)
        ])->withBody(File::get($filePath))->contentType('b2/x-auto')->post($uploadUrlBody['uploadUrl']);
        return $response;
    }
    public function uploadFiles(array $filePaths, $imgId)
    {
        return 1;
        error_log(json_encode($filePaths[0]));
        $authorizationBody = $this->getAuthorizationBody();
        error_log(json_encode($authorizationBody));
        $uploadUrlBody = $this->getUploadUrl($authorizationBody['authorizationToken'], $authorizationBody['apiInfo']['storageApi']['apiUrl']);
        $retryFiles = [];
        foreach ($filePaths as $index => $filePath) {
            $response = $this->uploadFileHttp($uploadUrlBody, $filePath, $imgId, $index);
            error_log(json_encode($response));
            error_log('first' . json_encode($response));

            error_log('first' . json_encode($response->status()));
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
        $authorizationBody = $this->getAuthorizationBody();
        return (object)['authorizationToken' => $authorizationBody['authorizationToken'], 'apiUrl' => $authorizationBody['apiInfo']['storageApi']['apiUrl']];
    }
}
