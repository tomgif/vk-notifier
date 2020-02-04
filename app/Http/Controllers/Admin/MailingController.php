<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailingSendRequest;
use App\Schedule;
use App\Subscription;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use VK\Client\VKApiClient;

class MailingController extends Controller
{
    /**
     * @var VKApiClient
     */
    protected $vkApiClient;

    public function __construct(VKApiClient $vkApiClient)
    {
        $this->vkApiClient = $vkApiClient;
    }

    /**
     * @param MailingSendRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \VK\Exceptions\Api\VKApiMessagesCantFwdException
     * @throws \VK\Exceptions\Api\VKApiMessagesChatBotFeatureException
     * @throws \VK\Exceptions\Api\VKApiMessagesChatUserNoAccessException
     * @throws \VK\Exceptions\Api\VKApiMessagesContactNotFoundException
     * @throws \VK\Exceptions\Api\VKApiMessagesDenySendException
     * @throws \VK\Exceptions\Api\VKApiMessagesKeyboardInvalidException
     * @throws \VK\Exceptions\Api\VKApiMessagesPrivacyException
     * @throws \VK\Exceptions\Api\VKApiMessagesTooLongForwardsException
     * @throws \VK\Exceptions\Api\VKApiMessagesTooLongMessageException
     * @throws \VK\Exceptions\Api\VKApiMessagesTooManyPostsException
     * @throws \VK\Exceptions\Api\VKApiMessagesUserBlockedException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function send(MailingSendRequest $request)
    {
        $subscribers = Subscription::where('is_subscribed', true)
            ->pluck('peer_id')
            ->toArray();

        $members = collect($this->vkApiClient->groups()->isMember(env('VK_API_TOKEN'), [
            'group_id' => env('VK_GROUP_ID'),
            'user_ids' => $subscribers
        ]))->reject(function ($member) {
            return !$member['member'];
        });

        if ($members->count() > 0) {

            $attachments = [];

            if ($request->input('files')) {
                foreach ($request->input('files') as $file) {
                    $uploadedImage = json_decode($file, true)[0];
                    $attachments[] = 'photo' . $uploadedImage['owner_id'] . '_' . $uploadedImage['id'];
                }
            }

            $this->vkApiClient->messages()->send(env('VK_API_TOKEN'), [
                'user_ids' => array_column($members->toArray(), 'user_id'),
                'random_id' => rand(),
                'message' => $request->message,
                'attachment' => implode(',', $attachments)
            ]);

            $schedule = Schedule::create([
                'when' => Carbon::now(),
                'name' => __('quick.mailing.heading'),
                'message' => $request->message,
                'attachments' => $request->input('files'),
                'user_id' => Auth::user()->id
            ]);

            $schedule->completed = true;
            $schedule->save();
        }

        return redirect()->back();
    }
}
