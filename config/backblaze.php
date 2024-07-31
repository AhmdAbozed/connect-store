<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    'blaze_key_id' => env('BLAZE_KEY_ID'),
    
    'blaze_key' => env('BLAZE_KEY'),
    
    'blaze_bucket_id'=> env('BLAZE_BUCKET_ID'),
    'blaze_token_duration' => env('BLAZE_TOKEN_DURATION')
];
