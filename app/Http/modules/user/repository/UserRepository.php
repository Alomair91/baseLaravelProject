<?php

namespace App\Http\modules\user\repository;

use App\Http\modules\base\repository\BaseApiRepository;
use App\Http\modules\user\model\User;

class UserRepository extends BaseApiRepository
{
    /**
     * BrandRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
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
        $query = $this->model->select(self::users("*"));

        // Where
        if ($value = $this->isExists($attributes, 'search')) {
            $query->where(function ($query) use ($value) {
                $query->where(self::users("id"), "LIKE", "%$value%")
                    ->orWhere(self::users("name"), "LIKE", "%$value%");
            });
        }

        return $this->result($attributes, $query, self::users());
    }

}
