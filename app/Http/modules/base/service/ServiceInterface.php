<?php

namespace App\Http\modules\base\service;

use Illuminate\Http\JsonResponse;

interface ServiceInterface
{

    /**
     * Display a listing of the resource with some filters.
     *
     * @param array $attributes
     * @return JsonResponse
     */
    public function index(array $attributes): JsonResponse;

    /**
     * Show the specified resource by id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse;

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data = []): JsonResponse;

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return JsonResponse
     */
    public function update(int $id, array $data = []): JsonResponse;

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse;

}
