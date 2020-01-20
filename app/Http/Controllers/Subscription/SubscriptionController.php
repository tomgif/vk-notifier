<?php

namespace App\Http\Controllers\Subscription;

use App\Subscription;
use App\Traits\SubscriptionStore;
use App\Traits\SubscriptionUpdate;

class SubscriptionController extends BaseSubscriptionController
{
    use SubscriptionStore, SubscriptionUpdate;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::paginate(10);

        return view('subscription.index', compact('subscriptions'));
    }
}
