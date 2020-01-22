<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailingSendRequest;
use App\Subscription;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use VK\Client\VKApiClient;

class MailingController extends Controller
{
    public function send(MailingSendRequest $request)
    {
        $vkApiClient = new VKApiClient;
        $attachments = [];

        if ($request->file('image')) {
            $messagesUploadServer = $vkApiClient->photos()->getMessagesUploadServer(env('VK_API_TOKEN'));

            $uploadUrl = $messagesUploadServer['upload_url'];

            if ($uploadUrl) {
                $vkResponse = (new Client)->request('POST', $uploadUrl, [
                    'multipart' => [
                        [
                            'name' => 'photo',
                            'contents' => fopen($request->file('image')->getPathname(), 'r'),
                            'filename' => $request->file('image')->getClientOriginalName()
                        ]
                    ]
                ])->getBody()->getContents();

                $uploadedImage = $vkApiClient->photos()->saveMessagesPhoto(env('VK_API_TOKEN'), json_decode($vkResponse, true));
                foreach ($uploadedImage as $image) {
                    $attachments[] = 'photo' . $image['owner_id'] . '_' . $image['id'];
                }
            }
        }

        $subscribers = Subscription::where('is_subscribed', true)->pluck('peer_id')->toArray();

        $members = $vkApiClient->groups()->isMember(env('VK_API_TOKEN'), [
            'group_id' => env('VK_GROUP_ID'),
            'user_ids' => $subscribers
        ]);

        $members = Arr::where($members, function ($user) {
            if ($user['member'] > 0) {
                return $user;
            }
            return false;
        });

        if (count($members) > 0) {
            $vkApiClient->messages()->send(env('VK_API_TOKEN'), [
                'user_ids' => array_column($members, 'user_id'),
                'random_id' => rand(),
                'message' => $request->message,
                'attachment' => implode(',', $attachments)
            ]);
        }

        return redirect()->back();
    }
}
