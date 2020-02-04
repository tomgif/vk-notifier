<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use VK\Client\VKApiClient;

class ImageUploadService
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
     * @param UploadedFile $uploadedFile
     * @return mixed
     * @throws \VK\Exceptions\Api\VKApiMessagesDenySendException
     * @throws \VK\Exceptions\Api\VKApiParamAlbumIdException
     * @throws \VK\Exceptions\Api\VKApiParamHashException
     * @throws \VK\Exceptions\Api\VKApiParamServerException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function process(UploadedFile $uploadedFile)
    {
        $uploadServer = $this->getServer();
        $uploadedFileInfo = $this->upload($uploadServer['upload_url'], $uploadedFile);

        return $this->save($uploadedFileInfo);
    }

    /**
     * Returns VK Upload Server Info
     * @return mixed
     * @throws \VK\Exceptions\Api\VKApiMessagesDenySendException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    private function getServer()
    {
        return $this->vkApiClient->photos()
            ->getMessagesUploadServer($this->token);
    }

    /**
     * Upload File to VK Server
     * @param string $url
     * @param UploadedFile $uploadedFile
     * @return mixed
     */
    private function upload(string $url, UploadedFile $uploadedFile)
    {
        $response = (new Client)->request('POST', $url, [
            'multipart' => [
                [
                    'name' => 'photo',
                    'contents' => fopen($uploadedFile->getPathname(), 'r'),
                    'filename' => $uploadedFile->getClientOriginalName()
                ]
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Register uploaded file in VK
     * @param array $uploadedFileInfo
     * @return mixed
     * @throws \VK\Exceptions\Api\VKApiParamAlbumIdException
     * @throws \VK\Exceptions\Api\VKApiParamHashException
     * @throws \VK\Exceptions\Api\VKApiParamServerException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    private function save(array $uploadedFileInfo)
    {
        return $this->vkApiClient->photos()
            ->saveMessagesPhoto($this->token, $uploadedFileInfo);
    }
}
