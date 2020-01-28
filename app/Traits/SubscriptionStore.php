<?php

namespace App\Traits;

use App\Http\Requests\SubscriptionRequest;
use App\Subscription;

trait SubscriptionStore
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\SubscriptionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SubscriptionRequest $request)
    {
        $subscription = new Subscription;

        $subscription->peer_id = $request->get('peer_id');
        $subscription->user_id = $request->get('user_id');
        $subscription->is_subscribed = $request->get('is_subscribed');

        $subscription->save();

        return redirect('/subscriptions');
    }
}
