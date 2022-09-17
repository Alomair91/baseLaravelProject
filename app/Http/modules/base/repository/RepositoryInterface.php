<?php

namespace App\Http\modules\base\repository;

interface  RepositoryInterface
{

    /**
     * Get all items with some filters
     *
     * @param array $attributes
     * @return mixed
     */
    public function getAll(array $attributes);

    /**
     * Get item by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Store new item
     *
     * @param array $data
     * @return mixed
     */
    public function save(array $data);

    /**
     * Update item
     *
     * @param int $id
     * @param array $data
     * @param bool $restore
     * @return mixed
     */
    public function updateById(int $id, array $data,bool $restore = false);


    /**
     * Delete item
     *
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);

}
