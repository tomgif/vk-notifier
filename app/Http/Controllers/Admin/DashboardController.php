<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use VK\Client\VKApiClient;

class DashboardController extends Controller
{
    protected $vkApiClient = null;

    /**
     * Create a new controller instance.
     *
     * @param VKApiClient $vkApiClient
     */
    public function __construct(VKApiClient $vkApiClient)
    {
        $this->vkApiClient = $vkApiClient;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * @throws \VK\Exceptions\Api\VKApiMessagesDenySendException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function index()
    {
        return view('admin.dashboard', compact('server'));
    }
}
