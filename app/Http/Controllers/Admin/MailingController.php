<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailingSendRequest;
use App\Services\ImageUploadService;
use App\Subscription;
use Illuminate\Support\Arr;
use VK\Client\VKApiClient;

class MailingController extends Controller
{
    protected $imageUploadService = null;
    protected $vkApiClient = null;

    public function __construct(ImageUploadService $imageUploadService, VKApiClient $vkApiClient)
    {
        $this->imageUploadService = $imageUploadService;
        $this->vkApiClient = $vkApiClient;
    }

    public function send(MailingSendRequest $request)
    {
        $attachments = [];

        if ($images = $request->file('images')) {
            if (is_array($images)) {
                foreach ($images as $image) {
                    $uploadedImages[] = $this->imageUploadService->process($image)[0];
                }
            } else {
                $uploadedImages[] = $this->imageUploadService->process($images)[0];
            }

            foreach ($uploadedImages as $uploadedImageImage) {
                $attachments[] = 'photo' . $uploadedImageImage['owner_id'] . '_' . $uploadedImageImage['id'];
            }
        }

        $subscribers = Subscription::where('is_subscribed', true)->pluck('peer_id')->toArray();

        $members = $this->vkApiClient->groups()->isMember(env('VK_API_TOKEN'), [
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
            $this->vkApiClient->messages()->send(env('VK_API_TOKEN'), [
                'user_ids' => array_column($members, 'user_id'),
                'random_id' => rand(),
                'message' => $request->message,
                'attachment' => implode(',', $attachments)
            ]);
        }

        return redirect()->back();
    }
}
