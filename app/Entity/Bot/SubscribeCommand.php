<?php

namespace App\Entity\Bot;

use App\Entity\Bot;
use App\Entity\Subscriber;
use App\Http\Requests\SubscriptionRequest;
use App\Subscription;
use App\Traits\SubscriptionStore;
use App\Traits\SubscriptionUpdate;

class SubscribeCommand implements Command
{
    use SubscriptionStore, SubscriptionUpdate;

    protected $subscriber = null;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function execute(): void
    {
        $subscription = Subscription::where('peer_id', $this->subscriber->getPeerId())
            ->first();

        $subscriptionStoreRequest = new SubscriptionRequest;

        $subscriptionStoreRequest->request->add([
            'peer_id' => $this->subscriber->getPeerId(),
            'user_id' => $this->subscriber->getUserId(),
            'is_subscribed' => true
        ]);

        if ($subscription) {
            $this->update($subscriptionStoreRequest, $subscription);
        } else {
            $this->store($subscriptionStoreRequest);
        }

        (new Bot())->sendSubscribeStatus($this->subscriber, true);
    }
}
