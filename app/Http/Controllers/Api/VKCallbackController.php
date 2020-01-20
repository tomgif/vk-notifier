<?php

namespace App\Http\Controllers\Api;

use App\Entity\Bot;
use App\Entity\Subscriber;
use Illuminate\Support\Facades\Log;

class VKCallbackController extends BaseApiController
{
    public function catch()
    {
        $subscriber = (new Subscriber)
            ->setExternalId($this->event['object']['id'])
            ->setPeerId($this->event['object']['peer_id'])
            ->setUserId($this->event['object']['from_id']);

        switch ($this->event['type']) {
            case 'confirmation':
                return env('VK_API_AUTH_STRING');

            case 'message_new':
                if (in_array('payload', array_keys($this->event['object']))) {

                    $payload = json_decode($this->event['object']['payload'], true);

                    $invoker = new Bot\Invoker;

                    switch ($payload['command']) {
                        case 'subscribe':
                            $subscribeCommand = new Bot\SubscribeCommand($subscriber);
                            $invoker->submit($subscribeCommand);
                            break;

                        case 'unsubscribe':
                            $unsubscribeCommand = new Bot\UnsubscribeCommand($subscriber);
                            $invoker->submit($unsubscribeCommand);
                            break;
                    }
                } else {
                    Log::info('сообщение');
                }

                break;
        }

        (new Bot)->communicate($subscriber);

        return env('VK_API_OK_RESPONSE');
    }
}
