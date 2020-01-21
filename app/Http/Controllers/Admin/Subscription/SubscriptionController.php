<?php

namespace App\Http\Controllers\Admin\Subscription;

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

        return view('admin.subscriptions.index', compact('subscriptions'));
    }
}
