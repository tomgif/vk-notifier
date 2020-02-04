<?php

namespace App\Entity;

use App\Subscription;
use VK\Client\VKApiClient;

class Subscriber
{
    /** @var int */
    protected $externalId;

    /** @var int */
    protected $peerId;

    /** @var int */
    protected $userId;

    /**
     * @return int
     */
    public function getExternalId(): int
    {
        return $this->externalId;
    }

    /**
     * @param int $externalId
     * @return Subscriber
     */
    public function setExternalId(int $externalId): Subscriber
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeerId(): int
    {
        return $this->peerId;
    }

    /**
     * @param int $peerId
     * @return Subscriber
     */
    public function setPeerId(int $peerId): Subscriber
    {
        $this->peerId = $peerId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return Subscriber
     */
    public function setUserId(int $userId): Subscriber
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSubscribed(): bool
    {
        $subscription = new Subscription;
        $subscription = $subscription::where('peer_id', $this->getPeerId())
            ->where('is_subscribed', true)
            ->first();

        if ($subscription) {
            return $subscription->is_subscribed;
        }

        return false;
    }

    /**
     * @param int $groupId
     * @param int $userId
     * @return bool
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function isMember(int $groupId, int $userId)
    {
        return (new VKApiClient)->groups()
            ->isMember(env('VK_API_TOKEN'), [
                'group_id' => $groupId,
                'user_id' => $userId,
            ]);
    }

    /**
     * @param int $peerId
     * @return bool
     */
    public function isConversation(int $peerId)
    {
        return $peerId > env('VK_CONVERSATION_START_ID');
    }
}
