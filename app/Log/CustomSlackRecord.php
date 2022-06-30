<?php

namespace App\Log;

use Monolog\Handler\Slack\SlackRecord;

class CustomSlackRecord extends SlackRecord
{
    public function __construct(SlackRecord $parent_record)
    {
        parent::__construct();

        $fields = [
            'channel', 'username', 'userIcon', 'useAttachment',
            'useShortAttachment', 'includeContextAndExtra', 'excludeFields', 'formatter',
            'normalizerFormatter',
        ];

        $rc = new \ReflectionClass($parent_record);
        foreach ($fields as $field) {
            $rp = $rc->getProperty($field);
            $rp->setAccessible(true);
            $rp->setValue($this, $rp->getValue($parent_record));
        }
    }

    public function getSlackData(array $record): array
    {
        $slack_data = parent::getSlackData($record);
        foreach ($slack_data['attachments'] as &$attachment) {
            $text_prefix        = sprintf("%s %s %s\n", $slack_data['icon_emoji'], $slack_data['channel'], $slack_data['username'],);
            $attachment['text'] = $text_prefix . $attachment['text'];
        }
        return $slack_data;
    }
}