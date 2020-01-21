<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Subscription;
use App\Traits\SubscriptionStore;
use App\Traits\SubscriptionUpdate;
use Illuminate\Support\Arr;

class SubscriptionController extends BaseSubscriptionController
{
    use SubscriptionStore, SubscriptionUpdate;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function index()
    {
        $subscriptions = Subscription::all();

        $subscribers = $this->vkApiClient->users()->get(env('VK_API_TOKEN'), [
            'user_ids' => $subscriptions->pluck('peer_id')->toArray(),
            'fields' => ['photo_50']
        ]);

        $subscriptions->map(function ($subscription) use ($subscribers) {
            $subscription->external_fields = Arr::first($subscribers, function ($subscriber) use ($subscription) {
                if ($subscriber['id'] == $subscription->peer_id) {
                    return $subscription;
                }
                return false;
            });

            return $subscription;
        });

        return view('admin.subscriptions.index', compact('subscriptions'));
    }
}
