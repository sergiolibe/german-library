<?php

use App\Log\CustomSlackWebhookHandler;

return [
    'default'  => env('LOG_CHANNEL', 'slack'),
    'channels' => [
        'slack' => [
            'driver'         => 'slack',
            'tap'            => [CustomSlackWebhookHandler::class],
            'url'            => env('LOG_SLACK_WEBHOOK_URL', 'NO_SLACK_WEBHOOK_URL'),
            'username'       => 'GERMAN-LIBRARY-PROD',
            'emoji'          => ':warning::books::boom:',//':boom:',
            'level'          => 'debug',
            'channel'        => '#german-reference',
        ],
    ],
];
