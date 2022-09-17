<?php

namespace App\Http\modules\products\repository;

use App\Http\modules\base\repository\BaseApiRepository;
use App\Http\modules\products\model\Category;

class CategoryRepository extends BaseApiRepository
{
    /**
     * CategoryRepository constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
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
        $query = $this->model->select(self::categories("*"));

        // Where
        if ($value = $this->isExists($attributes, 'search')) {
            $query->where(function ($query) use ($value) {
                $query->where(self::categories("id"), "LIKE", "%$value%")
                    ->orWhere(self::categories("name"), "LIKE", "%$value%");
            });
        }

        return $this->result($attributes, $query, self::categories());
    }

}
