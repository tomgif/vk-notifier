<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailingSendRequest;
use App\Subscription;
use Illuminate\Support\Arr;
use VK\Client\VKApiClient;
use Illuminate\Http\Request;

class MailingController extends Controller
{
    protected $vkApiClient = null;

    public function __construct()
    {
        $this->vkApiClient = new VKApiClient;
    }

    public function send(MailingSendRequest $request)
    {
        $subscribers = Subscription::where('is_subscribed', true)->pluck('peer_id')->toArray();

        $members = $this->vkApiClient->groups()->isMember(env('VK_API_TOKEN'), [
            'group_id' => env('VK_GROUP_ID'),
            'user_ids' => $subscribers
        ]);

        $members = Arr::where($members, function ($user) {
            if ($user['member'] > 0)
                return $user;
            return false;
        });

        if (count($members) > 0) {
            $this->vkApiClient->messages()->send(env('VK_API_TOKEN'), [
                'user_ids' => array_column($members, 'user_id'),
                'random_id' => rand(),
                'message' => $request->message
            ]);
        }

        return redirect()->back();
    }
}
