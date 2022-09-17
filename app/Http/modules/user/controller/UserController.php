<?php

namespace App\Http\modules\user\controller;

use App\Http\modules\base\controller\BaseApiController;
use App\Http\modules\products\service\BrandService;
use App\Http\modules\user\service\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    protected $activeAuthApi = false;

    /**
     * UserController Constructor
     *
     * @param AuthService $service
     *
     */
    public function __construct(AuthService $service)
    {
        parent::__construct($service);
    }

    public function index(Request $request): JsonResponse
    {
        return $this->noResponse();
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        return $this->noResponse();
    }



    public function login(Request $request): JsonResponse
    {
        $attributes = $request->only($this->service->fillable);
        return $this->service->login($attributes);
    }
    public function logout(Request $request): JsonResponse
    {
        return $this->service->logout($request);
    }
}
