<?php

namespace App\Entity\Bot;

use App\Entity\Bot;
use App\Entity\Subscriber;
use App\Http\Requests\SubscriptionRequest;
use App\Subscription;
use App\Traits\SubscriptionStore;
use App\Traits\SubscriptionUpdate;

class UnsubscribeCommand implements Command
{
    use SubscriptionStore, SubscriptionUpdate;

    /** @var Subscriber|null  */
    protected $subscriber = null;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Executes command from invoker
     */
    public function execute(): void
    {
        $subscription = Subscription::where('peer_id', $this->subscriber->getPeerId())
            ->first();

        $subscriptionStoreRequest = new SubscriptionRequest;
        $subscriptionStoreRequest->request->add(['peer_id' => $this->subscriber->getPeerId()]);
        $subscriptionStoreRequest->request->add(['user_id' => $this->subscriber->getUserId()]);
        $subscriptionStoreRequest->request->add(['is_subscribed' => false]);

        if ($subscription) {
            $this->update($subscriptionStoreRequest, $subscription);
        } else {
            $this->store($subscriptionStoreRequest);
        }

        (new Bot())->sendSubscribeStatus($this->subscriber, false);
    }
}
