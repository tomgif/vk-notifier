<?php

namespace App\Jobs;

use App\Entity\Keyboard;
use App\Schedule;
use App\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use VK\Client\VKApiClient;

class ProcessSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Execute the job.
     * @param VKApiClient $vkApiClient
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
     * @throws \Exception
     */
    public function handle(VKApiClient $vkApiClient)
    {
        $schedule = Schedule::where('job_id', $this->job->getJobId())->first();

        $attachments = [];

        foreach (json_decode($schedule->attachments, true) as $file) {
            $uploadedImage = json_decode($file, true)[0];
            $attachments[] = 'photo' . $uploadedImage['owner_id'] . '_' . $uploadedImage['id'];
        }

        $subscribers = Subscription::where('is_subscribed', true)
            ->pluck('peer_id')
            ->toArray();

        $members = collect($vkApiClient->groups()->isMember(env('VK_API_TOKEN'), [
            'group_id' => env('VK_GROUP_ID'),
            'user_ids' => $subscribers
        ]))->reject(function ($member) {
            return !$member['member'];
        });

        if ($members->count() > 0) {
            $vkApiClient->messages()->send(env('VK_API_TOKEN'), [
                'user_ids' => array_column($members->toArray(), 'user_id'),
                'random_id' => rand(),
                'message' => $schedule->message,
                'attachment' => implode(',', $attachments),
                //'keyboard' => (new Keyboard())->setInline()->setPrimaryLink('Посетить сайт', 'http://reincarnation.su')->toString()
            ]);

            $schedule->completed = true;
            $schedule->save();
        }
    }
}
