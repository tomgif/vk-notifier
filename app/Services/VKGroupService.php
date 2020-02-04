<?php

namespace App\Services;

use VK\Client\VKApiClient;

class VKGroupService
{
    /** @var VKApiClient */
    protected $vkApiClient;

    /** @var string */
    protected $token;

    public function __construct(VKApiClient $vkApiClient)
    {
        $this->vkApiClient = $vkApiClient;
        $this->token = env('VK_API_TOKEN');
    }

    /**
     * @return mixed
     * @throws \VK\Exceptions\Api\VKApiParamGroupIdException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function getMembers()
    {
        /* max 1000 users, use offset if need more */
        return $this->vkApiClient->groups()->getMembers($this->token, [
            'group_id' => env('VK_GROUP_ID')
        ]);
    }
}
