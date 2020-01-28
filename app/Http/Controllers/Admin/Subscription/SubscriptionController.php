<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Subscription;
use App\Traits\SubscriptionStore;
use App\Traits\SubscriptionUpdate;
use VK\Client\VKApiClient;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    use SubscriptionStore, SubscriptionUpdate;

    protected $vkApiClient = null;

    public function __construct(VKApiClient $vkApiClient)
    {
        $this->vkApiClient = $vkApiClient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
            $subscription->external_fields = collect($subscribers)
                ->where('id', $subscription->peer_id)
                ->first();
            return $subscription;
        });

        return view('admin.subscriptions.index', compact('subscriptions'));
    }
}
