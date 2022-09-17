<?php

namespace App\Http\modules\base\service;

use App\Http\modules\base\repository\BaseApiRepository;
use App\Http\modules\base\repository\BaseRepository;
use Illuminate\Http\JsonResponse;

/*
 * This class Will do:
 * - return CRUD response
 */

abstract class BaseApiService extends BaseService implements ServiceInterface
{

    public $checkAuth = false;

    public $repository;

    /**
     * The attributes that want to filter by.
     */
    public $filters = [];

    /**
     * The attributes that want to insert or update.
     */
    public $fillable = [];

    /**
     * The attributes that want to validate.
     */
    protected $validationRules = [];


    /**
     * BaseApiService constructor.
     *
     * @param BaseApiRepository $repository
     */
    public function __construct(BaseApiRepository $repository)
    {
        $this->repository = $repository;

    }


    public function requestFilters(): array
    {
        $filters = $this->repository->baseFilters;
        foreach ($this->filters as $filter) {
            $filters[] = $filter;
        }
        return $filters;
    }


    /**
     * Get all items.
     *
     * @param array $attributes
     * @return JsonResponse
     */
    public function index(array $attributes): JsonResponse
    {
        return $this->execute($this->checkAuth, function () use ($attributes) {

            if ($result = $this->repository->getAll($attributes)) {
                if ($this->isExists($attributes, BaseRepository::pageNumber)) {
                    return $this->responseWithItemsAndMeta($result);
                } else {
                    return $this->responseWithData($result);
                }
            }

            return parent::responseErrorThereIsNoData();
        });
    }

    /**
     * Get item by id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return $this->execute($this->checkAuth, function () use ($id) {

            if ($result = $this->repository->getById($id))
                return $this->responseWithData($result);

            return parent::responseErrorThereIsNoData();
        });
    }


    /**
     * Validate  data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data = []): JsonResponse
    {
        return $this->execute($this->checkAuth, function () use ($data) {
            if ($value = self::validate($data, $this->validationRules))
                return $value;

            $result = $this->repository->save($data);

            if (!$result)
                return $this->responseErrorCanNotSaveData();

            return $this->responseWithData($result);
        });
    }

    /**
     * Update  data  by id
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @param int $id
     * @return JsonResponse
     */
    public function update(int $id, array $data = [], bool $restore = false): JsonResponse
    {
        return $this->execute($this->checkAuth, function () use ($id, $data, $restore) {
            if ($value = self::validate($data, $this->validationRules))
                return $value;

            return $this->dbTransaction(function () use ($id, $data, $restore) {

                return $this->repository->updateById($id, $data, $restore);

            });
        });
    }

    /**
     * Delete item by id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->execute($this->checkAuth, function () use ($id) {

            return $this->dbTransaction(function () use ($id) {

                return $this->repository->deleteById($id);

            });
        });
    }
}
