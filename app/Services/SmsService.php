<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class SmsService
{
    protected $apiUrl;
    protected $apiKey;
    protected $senderId;

    public function __construct()
    {
        $this->apiUrl = config('sms.api_url');
        $this->apiKey = config('sms.api_key');
        $this->senderId = config('sms.sender_id');
    }

    public function sendOtp($phoneNumber, $token, $user_id)
    {
        try {
            $formattedNumber = $this->formatEgyptianNumber($phoneNumber);
            error_log($formattedNumber);
            error_log($this->apiKey);
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://api.unimtx.com/?action=otp.send&accessKeyId='.$this->apiKey, [
                'to' => $formattedNumber,
                'code' => $token,
                'channel'=>'whatsapp'
            ]);
            $statusCode = $response->getStatusCode();
            
            error_log(json_encode($response));
            error_log(json_encode($response->getBody()));
            error_log($response->body());
            error_log($statusCode);
            $responseBody = json_decode($response->getBody(), true);
            if ($statusCode == 200) {
                $oldOtp = Otp::query()->find($user_id);
                if ($oldOtp) $oldOtp->remove();
                Otp::query()->create([
                    'user_id' => $user_id,
                    'token' => $token
                ]);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            Log::error('SMS sending failed: ' . $e->getMessage());
            abort(400, 'Failed to send OTP');
            return false;
        }
    }
    private function formatEgyptianNumber($number)
    {
        // Remove any non-digit characters
        $number = preg_replace('/\D/', '', $number);

        // Check if the number starts with 0 and is 11 digits long
        if (substr($number, 0, 1) === '0' && strlen($number) === 11) {
            // Remove the leading 0
            $number = substr($number, 1);
        } else {
            abort(422, json_encode([
                'message' => 'Validation failed',
                'errors' => ['number' => ['Invalid egyptian number format.']]
            ]));
        }

        // Prepend the country code for Egypt (+20)
        return '+20' . $number;
    }

    public function verifyOtp(string $user_id, string $number, string $token)
    {


        //$phoneNumber = $request->input('phone_number');
        //$inputOtp = $request->input('otp');

        // Retrieve the OTP from cache
        $otp = Otp::where('user_id', $user_id)->where('phone_number', $number)
            ->where('token', $token)
            ->first();

        if ($otp) {
            // Check if the OTP is expired
            $isExpired = $otp->created_at->addMinutes(10)->isPast();

            if ($isExpired) {
                // OTP is expired
                return response()->json(['message' => 'Code has expired.'], 403);
            } else {
                // OTP is still valid
                User::query()->find($user_id)->update(['number_verified_at' => now()]);
                $otp->delete();
                return response()->json(['message' => 'OTP verified successfully'], 200);
            }
        } else {
            // OTP was not found
            return response()->json(['message' => 'Invalid Code.'], 403);
        }
    }
}
