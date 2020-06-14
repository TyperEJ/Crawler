<?php

return [
    'line_bot' => [
        'channel_id' => env('LINE_BOT_CHANNEL_ID'),
        'channel_secret' => env('LINE_BOT_CHANNEL_SECRET'),
        'channel_token' => env('LINE_BOT_CHANNEL_TOKEN'),
    ],
    'line_login' => [
        'channel_id' => env('LINE_LOGIN_CHANNEL_ID'),
        'channel_secret' => env('LINE_LOGIN_CHANNEL_SECRET'),
    ],
    'line_notify' => [
        'channel_id' => env('LINE_NOTIFY_CHANNEL_ID'),
        'channel_secret' => env('LINE_NOTIFY_CHANNEL_SECRET'),
    ]
];
