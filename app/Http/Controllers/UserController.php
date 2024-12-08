<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use App\Models\User;
use App\Services\CaptchaService;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function signup(SignupRequest $request, User $user, SmsService $smsService, CaptchaService $captchaService): Response
    {
        $captchaService->verifyCaptcha($request->input('g-recaptcha-response'), $request->ip());
        $signedUpUser = $user->signUp($request->input("username"), $request->input("password"), $request->input("email"), $request->input("number"), $request->input("type"),$request->input('g-recaptcha-response'), $request->ip());
        error_log($signedUpUser->id);
        if ($signedUpUser->id) {
            Auth::login($signedUpUser);
        }
        return response(200);
    }
    public function login(Request $request, User $user)
    {
        error_log('inside login');
        return response($user->login($request->input("username"), $request->input("password")));
    }
    public function sendOtp(Request $request, SmsService $smsService, CaptchaService $captchaService=null)
    {
        error_log('inside sendotp');
        if ($captchaService) {
        $captchaService->verifyCaptcha($request->input('g-recaptcha-response'), $request->ip());
        }
        // Proceed with the rest of the logic if CAPTCHA is valid
        $otp = rand(100000, 999999);
        error_log($otp);
        error_log('$otp?');
        return response($smsService->sendOtp($request->input('number'), $otp, $request->user()->id));
    }
    public function verifyOtp(Request $request, SmsService $smsService)
    {
        return response($smsService->verifyOtp($request->user()->id, $request->user()->phone_number, $request->input('code')));
    }
    public function signout(Request $request)
    {
        Auth::logout(); // Log the user out
        return redirect('/login')->with('message', 'You have been logged out successfully.');
    }
    public function approveTrader(Request $request, User $user, $user_id){
        error_log($request->input('status'));
        $status = $request->input('status');
        if($status == 'trader' || $status =='rejected' || $status=='pending'){
            return response($user->handleTrader($user_id, $request->input('status')));
        }else{
            abort(400, 'Invalid status');
        }
    }
}
