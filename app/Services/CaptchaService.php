<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class CaptchaService
{

    public function verifyCaptcha(string $captchaResponse,string $ip)
    {
        error_log('inside  captcha');
        if (!$captchaResponse) {

            error_log('inside  captcha check');
            abort(403, ['error' => 'Captcha is required.']);
        }
        error_log($captchaResponse);
        error_log(config('captcha.captcha_secret'));

        error_log($ip);
        // Verify CAPTCHA using Google reCAPTCHA API
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('captcha.captcha_secret'),
            'response' => $captchaResponse,
            'remoteip' => $ip,
        ]);

        $captchaSuccess = json_decode($response->body());

        error_log($response->body());
        if (!$captchaSuccess->success) {
            abort(403, ['error' => 'Captcha validation failed.']);
        }
        return true;
    }
}
