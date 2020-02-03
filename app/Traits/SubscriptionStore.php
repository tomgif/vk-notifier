<?php

namespace App\Traits;

use App\Subscription;
use Illuminate\Http\Request;

trait SubscriptionStore
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Subscription::create($request->all());

        return redirect()->route('admin.subscriptions.index');
    }
}
