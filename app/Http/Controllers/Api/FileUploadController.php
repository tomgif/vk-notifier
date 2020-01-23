<?php

namespace App\Http\Controllers\Api;

use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{
    protected $imageUploadService = null;
    protected $vkApiClient = null;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \VK\Exceptions\Api\VKApiMessagesDenySendException
     * @throws \VK\Exceptions\Api\VKApiParamAlbumIdException
     * @throws \VK\Exceptions\Api\VKApiParamHashException
     * @throws \VK\Exceptions\Api\VKApiParamServerException
     * @throws \VK\Exceptions\VKApiException
     * @throws \VK\Exceptions\VKClientException
     */
    public function uploadFile2VK(Request $request)
    {
        return $this->imageUploadService->process($request->file('files')[0]);
    }
}
