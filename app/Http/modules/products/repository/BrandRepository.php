<?php

namespace App\Http\modules\products\repository;

use App\Http\modules\base\repository\BaseApiRepository;
use App\Http\modules\products\model\Brand;

class BrandRepository extends BaseApiRepository
{
    /**
     * BrandRepository constructor.
     *
     * @param Brand $model
     */
    public function __construct(Brand $model)
    {
        $this->model = $model;
    }

    /**
     * Get all accounts.
     *
     * @param array $attributes
     * @return mixed
     */
    public function getAll(array $attributes)
    {
        // Select
        $query = $this->model->select(self::brands("*"));

        // Where
        if ($value = $this->isExists($attributes, 'search')) {
            $query->where(function ($query) use ($value) {
                $query->where(self::brands("id"), "LIKE", "%$value%")
                    ->orWhere(self::brands("name"), "LIKE", "%$value%");
            });
        }

        return $this->result($attributes, $query, self::brands());
    }

}
