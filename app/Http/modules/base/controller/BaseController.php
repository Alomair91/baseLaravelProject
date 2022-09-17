<?php

namespace App\Http\modules\base\controller;

use App\Http\Common\response\HTTPCode;
use App\Http\modules\base\service\BaseApiService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $service;


    protected $activeAuthApi = false;


    /**
     * BaseController Constructor
     *
     * @param BaseApiService $service
     *
     */
    public function __construct(BaseApiService $service)
    {
        $this->service = $service;
        if ($this->activeAuthApi)
            $this->middleware('auth:api');
    }

    public function noResponse(): JsonResponse
    {
        return response()->json([
                "status" => HTTPCode::InternalError,
                'message' => trans('No data')
            ], HTTPCode::InternalError);
    }
}
