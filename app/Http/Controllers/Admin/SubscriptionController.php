<?php

namespace App\Http\Controllers\Admin;

use App\Services\VKGroupService;
use App\Subscription;
use App\Traits\SubscriptionStore;
use App\Traits\SubscriptionUpdate;
use VK\Client\VKApiClient;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    use SubscriptionStore, SubscriptionUpdate;

    /** @var VKApiClient */
    protected $vkApiClient;

    /** @var VKGroupService */
    protected $vkGroupService;

    public function __construct(VKApiClient $vkApiClient, VKGroupService $vkGroupService)
    {
        $this->vkApiClient = $vkApiClient;
        $this->vkGroupService = $vkGroupService;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function index()
    {
        $subscriptions = Subscription::all();

        $subscribers = $this->vkApiClient->users()->get(env('VK_API_TOKEN'), [
            'user_ids' => $subscriptions->pluck('peer_id')->toArray(),
            'fields' => ['domain', 'photo_50']
        ]);

        $subscriptions->map(function ($subscription) use ($subscribers) {
            $subscription->external_fields = collect($subscribers)
                ->where('id', $subscription->peer_id)
                ->first();
            return $subscription;
        });

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Remove subscription.
     * @param Subscription $subscription
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')
            ->with('info', __('subscriptions.destroy.info'));
    }

    /**
     * Fetch user from vk group
     * @return \Illuminate\Http\RedirectResponse
     * @throws \VK\Exceptions\Api\VKApiParamGroupIdException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function fetch()
    {
        $members = $this->vkGroupService->getMembers();

        $notSubscribed = collect($members['items'])
            ->diff(Subscription::pluck('user_id'))
            ->map(function ($member) {
                return [
                    'user_id' => $member,
                    'peer_id' => $member,
                    'is_subscribed' => false
                ];
            });

        if ($notSubscribed->count()) {
            Subscription::insert($notSubscribed->toArray());
        }

        return redirect()->back()
            ->with('info', __('subscriptions.fetch', [
                'count' => $notSubscribed->count()
            ]));
    }
}
