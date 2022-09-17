<?php

namespace App\Http\modules\base\controller;

use App\Http\modules\base\service\BaseApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseApiController extends BaseController
{

    /**
     * BaseApiController Constructor
     *
     * @param BaseApiService $service
     */
    public function __construct(BaseApiService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $attributes = $request->only($this->service->requestFilters());
        return $this->service->index($attributes);
    }

    /**
     * Show the specified resource by id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        return $this->service->show($id);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $attributes = $request->only($this->service->fillable);
        return $this->service->store($attributes);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $attributes = $request->only($this->service->fillable);
        return $this->service->update($id, $attributes, $request->get("restore") ?? false);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        return $this->service->destroy($id);
    }
}
