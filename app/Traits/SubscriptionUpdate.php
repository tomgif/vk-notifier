<?php

namespace App\Traits;

use App\Subscription;
use App\Http\Requests\SubscriptionRequest;

trait SubscriptionUpdate
{
    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\SubscriptionRequest $request
     * @param \App\Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->peer_id = $request->get('peer_id');
        $subscription->user_id = $request->get('user_id');
        $subscription->is_subscribed = $request->get('is_subscribed');

        if ($subscription->isDirty()) {
            $subscription->save();
        }

        return redirect('/subscriptions');
    }
}
