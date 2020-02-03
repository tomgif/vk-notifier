<?php

namespace App\Entity\Bot;

use App\Entity\Subscriber;
use App\Subscription;
use App\Traits\SubscriptionStore;
use App\Traits\SubscriptionUpdate;
use Illuminate\Http\Request;

class SubscribingCommand
{
    use SubscriptionStore, SubscriptionUpdate;

    /** @var Subscriber */
    protected $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * @param bool $isSubscribed
     */
    protected function subscribing(bool $isSubscribed)
    {
        $subscription = Subscription::where('peer_id', $this->subscriber->getPeerId())->first();

        $subscriptionStoreRequest = new Request([
            'peer_id' => $this->subscriber->getPeerId(),
            'user_id' => $this->subscriber->getUserId(),
            'is_subscribed' => $isSubscribed,
        ]);

        if ($subscription) {
            $this->update($subscriptionStoreRequest, $subscription);
        } else {
            $this->store($subscriptionStoreRequest);
        }
    }
}
