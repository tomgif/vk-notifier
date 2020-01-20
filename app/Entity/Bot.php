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

        if ($subscriber->isSubscribed()) {
            $keyboard->setNegativeButton(__('keyboard.unsubscribe'), ['command' => 'unsubscribe']);
        } else {
            $keyboard->setPositiveButton(__('keyboard.subscribe'), ['command' => 'subscribe']);
        }

        //extra buttons can be added here

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

    public function sendSubscribeStatus(Subscriber $subscriber, bool $status)
    {
        $this->client->messages()->send(env('VK_API_TOKEN'), [
            'peer_id' => $subscriber->getPeerId(),
            'random_id' => rand(),
            'message' => __($status ? 'bot.subscribe' : 'bot.unsubscribe')
        ]);
    }
}