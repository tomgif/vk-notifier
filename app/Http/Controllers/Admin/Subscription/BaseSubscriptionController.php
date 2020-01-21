<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller;
use VK\Client\VKApiClient;

abstract class BaseSubscriptionController extends Controller
{
    protected $vkApiClient = null;

    public function __construct()
    {
        $this->vkApiClient = new VKApiClient;
    }
}
