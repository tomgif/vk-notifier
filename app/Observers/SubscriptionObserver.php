<?php

namespace App\Observers;

use App\Subscription;
use App\Traits\SubscriptionUpdate;
use Illuminate\Http\Request;
use VK\Client\VKApiClient;

class SubscriptionObserver
{
    use SubscriptionUpdate;

    /**
     * @var VKApiClient
     */
    protected $vkApiClient;

    public function __construct(VKApiClient $vkApiClient)
    {
        $this->vkApiClient = $vkApiClient;
    }

    public function sendStatus(Subscription $subscription)
    {
        $this->vkApiClient->messages()->send(env('VK_API_TOKEN'), [
            'peer_id' => $subscription->peer_id,
            'random_id' => rand(),
            'message' => __($subscription->is_subscribed ? 'bot.subscribe' : 'bot.unsubscribe')
        ]);
    }

    public function created(Subscription $subscription)
    {
        $this->sendStatus($subscription);
    }

    public function updated(Subscription $subscription)
    {
        $this->sendStatus($subscription);
    }

    public function deleting(Subscription $subscription)
    {
        if ($subscription->is_subscribed) {
            $this->update(new Request([
                'peer_id' => $subscription->peer_id,
                'user_id' => $subscription->user_id,
                'is_subscribed' => false,
            ]), $subscription);
        }
    }
}
