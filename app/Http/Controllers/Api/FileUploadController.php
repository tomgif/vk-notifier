<?php

namespace App\Http\Controllers\Api;

use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{
    protected $imageUploadService = null;

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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function deleteFileFromVK(Request $request)
    {
        //may be rollback something
        return response(['success' => true]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function load(Request $request)
    {
        /**
         * Todo: move to imageUploadService
         */
        $externalFile = collect(
            json_decode($request->load, true)[0]['sizes']
        )->last();

        $response = (new \GuzzleHttp\Client)
            ->get($externalFile['url']);

        $file = $response->getBody()->getContents();
        $contentType = $response->getHeader('Content-type');

        return response($file)->header('Content-type', $contentType[0]);
    }
}
