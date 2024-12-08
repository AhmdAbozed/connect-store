<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\HasApiTokens;

use function Laravel\Prompts\error;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'number_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function login(string $username, string $password)
    {
        //Auth::attempt creates the session needed for auth if successful 
        if (Auth::attempt(['name' => $username, 'password' => $password])) {
            return 200;
        } else {
            abort(response()->json(['errorMsg' => 'Invalid Username or Password.'], 403));
        }
    }

    public function signUp(string $username, string $password, string $email, string $number, string $type)
    {

        error_log('huh');
        if (User::where('email', $email)->exists()) {
            abort(response()->json('Email already in-use.', 403));
        }
        if (User::where('phone_number', $number)->exists()) {
            abort(response()->json('Phone number already in-use.', 403));
        }
        if (User::where('name', $username)->exists()) {
            abort(response()->json('Username already in-use.', 403));
        }

        $User = User::create([
            'name' => $username,
            'password' => $password,
            'phone_number' => $number,
            'email' => $email,
            'type' => $type
        ]);
        $auth = Auth::attempt(['name' => $username, 'password' => $password]);
        return $User;
    }
    public function handleTrader($user_id, $status){
        $trader = User::query()->find($user_id);
        if($trader){
            $trader->type = $status;
            $trader->save();
            error_log(json_encode(User::query()->find($user_id)));
            return $trader;
        }else{
            abort(400, 'trader not found');
        }        
    }
}
