<?php

namespace App\Http\modules\products\repository;

use App\Http\modules\base\repository\BaseApiRepository;
use App\Http\modules\products\model\Product;

class ProductRepository extends BaseApiRepository
{
    /**
     * ProductRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
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
        $query = $this->model->select(self::products("*"))->with(["category","brand"]);

        // Where
        if (($value = $this->isExists($attributes, 'category_id')) != null)
            $query->where(self::products('category_id'), $value);

        if (($value = $this->isExists($attributes, 'brand_id')) != null)
            $query->where(self::products('brand_id'), $value);

        if ($value = $this->isExists($attributes, 'search')) {
            $query->where(function ($query) use ($value) {
                $query->where(self::products("id"), "LIKE", "%$value%")
                    ->orWhere(self::products("name"), "LIKE", "%$value%")
                    ->orWhere(self::products("details"), "LIKE", "%$value%");
            });
        }

        return $this->result($attributes, $query, self::products());
    }

    /**
     * Get by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->select(self::products("*"))->with(["category","brand"])->where('id', $id)->first();
    }

}
