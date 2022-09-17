<?php

namespace App\Http\modules\base\repository;


class  BaseApiRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * Get all with base filter.
     *
     * @param array $attributes
     * @return mixed
     */
    public function getAll(array $attributes)
    {
        // Select
        $query = $this->model->select("*");

        return $this->result($attributes, $query, $this->model->getTable());
    }

    /**
     * Get by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Save new data
     *
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        $this->createdBy($data);
        return $this->model->create($data);
    }

    /**
     * Update by id
     *
     * @param array $data
     * @param int $id
     * @param bool $restore
     * @return mixed
     */
    public function updateById(int $id, array $data, bool $restore = false)
    {
        $this->updatedBy($data);

        if($restore)
            $item = $this->model->withTrashed()->find($id);
        else
            $item = $this->model->find($id);

        if ($item) {
            if ($restore) $item->restore();
            $item->update($data);
        }
        return $item;
    }

    /**
     * Delete by id
     *
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        $object = $this->model->find($id);
        if ($object) {
            $object->delete();
            // determine if a given model instance has been soft deleted, use the trashed method:
            if ($object->trashed())
                return true;
        }
        return false;
    }
}
