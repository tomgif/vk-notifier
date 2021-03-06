<?php

namespace App\Http\Controllers\Api;

use App\Entity\Bot;
use App\Entity\Subscriber;

class VKCallbackController extends BaseApiController
{
    /**
     * Catch VK Callback API event
     * @return mixed
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function catch()
    {
        switch ($this->event['type']) {
            case 'confirmation':
                return env('VK_API_AUTH_STRING');

            case 'message_new':
                $subscriber = (new Subscriber)
                    ->setExternalId($this->event['object']['id'])
                    ->setPeerId($this->event['object']['peer_id'])
                    ->setUserId($this->event['object']['from_id']);

                if ($subscriber->isConversation($subscriber->getPeerId()))
                    break;

                if (!$subscriber->isMember($this->event['group_id'], $subscriber->getUserId()))
                    break;

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
                }

                (new Bot)->communicate($subscriber);

                break;
        }

        return env('VK_API_OK_RESPONSE');
    }
}
