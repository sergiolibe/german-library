<?php

namespace App\Log;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\SlackWebhookHandler;

class CustomSlackWebhookHandler
{

    /**
     * Customize the given logger instance.
     * @param Logger $logger
     * @return void
     */
    public function __invoke(Logger $logger): void
    {
//        $dateFormat = "Y-m-d H:i:s";
//        $checkLocal = env('APP_ENV');

        foreach ($logger->getHandlers() as $handler) {
            if ($handler instanceof SlackWebhookHandler) {
//                $output    = "[$checkLocal]: %datetime% > %level_name% - %message% `%context% %extra%` :poop: \n";
//                $formatter = new LineFormatter($output, $dateFormat);

                $custom_slack_record = new CustomSlackRecord($handler->getSlackRecord());
                $rc                  = new \ReflectionClass($handler);

                $rp = $rc->getProperty('slackRecord');
                $rp->setAccessible(true);
                $rp->setValue($handler, $custom_slack_record);

//                $handler->pushProcessor(function ($record) {
//                    $record['extra']['dummy'] = 'test';
//                    return $record;
//                });
            }
        }
    }


}