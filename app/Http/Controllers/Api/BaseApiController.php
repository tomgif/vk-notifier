<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class BaseApiController
 * @package App\Http\Controllers\Api
 */
abstract class BaseApiController extends Controller
{
    protected $event = [];

    public function __construct(Request $request)
    {
        $event = $request->all();

        $this->event = $event;
    }
}
