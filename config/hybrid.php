<?php
return [
    "base_url"   => "http://earlyme.app:8000/login/endpoint",
    "providers"  => [
        "Facebook" => [
            "enabled" => true,
            "keys"    => [ "id" => env('FACEBOOK_KEYS_ID'), "secret" => env('FACEBOOK_KEYS_SECRET') ],
            "scope"   => "public_profile, email, user_friends", // optional
        ]
    ],
    "debug_mode" => true,
    "debug_file" => __DIR__.'/../storage/logs/hybrid.log',
];