<?php

namespace App\Traits;

use App\Subscription;
use Illuminate\Http\Request;

trait SubscriptionUpdate
{
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Subscription $subscription)
    {
        $subscription->fill($request->all());
        $subscription->save();

        return redirect()->route('admin.subscriptions.index')
            ->with('info', __('subscriptions.update.info'));
    }
}
