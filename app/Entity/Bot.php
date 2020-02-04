<?php

namespace App\Entity;

use VK\Client\VKApiClient;

class Bot
{
    protected $client = null;

    public function __construct()
    {
        $this->client = new VKApiClient;
    }

    public function communicate(Subscriber $subscriber)
    {
        $keyboard = new Keyboard;
        $keyboard->setInline();

        if ($subscriber->isSubscribed()) {
            $keyboard->setSecondaryButton(__('keyboard.unsubscribe'), ['command' => 'unsubscribe']);
        } else {
            $keyboard->setPositiveButton(__('keyboard.subscribe'), ['command' => 'subscribe']);
        }

        $this->sendStartMessage($subscriber, $keyboard);
    }

    public function sendStartMessage(Subscriber $subscriber, Keyboard $keyboard)
    {
        $this->client->messages()->send(env('VK_API_TOKEN'), [
            'peer_id' => $subscriber->getPeerId(),
            'random_id' => rand(),
            'message' => __('bot.start'),
            'keyboard' => $keyboard->toString()
        ]);
    }
}
