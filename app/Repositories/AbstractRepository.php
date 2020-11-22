<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    /**
     * @var Model
     */
    protected $entity;

    /**
     * @var array
     */
    protected $relations = [];

    /**
     * @var array
     */
    protected $perPage = 15;

    /**
     * @return array
     */
    public function getCrudLookUps()
    {
        return [];
    }

    /**
     * @param $parameters
     * @param null $perPage
     * @param string $orderColumn
     * @param string $orderBy
     *
     * @return LengthAwarePaginator
     */
    public function getAll($parameters = [], $perPage = null, $orderColumn = 'id', $orderBy = 'desc')
    {
        return $this->queryFilterParams($parameters)->orderBy($orderColumn, $orderBy)->paginate($this->perPage);
    }

    /**
     * @param array $parameters
     *
     * @return Builder[]|Collection
     */
    public function getList($parameters = [])
    {
        return $this->queryFilterParams($parameters)->get();
    }

    public function getColumn($pluck, $parameters = [])
    {
        return $this->queryFilterParams($parameters)->pluck($pluck);
    }

    /**
     * @param $parameters
     *
     * @return Model|null|static
     */
    public function getSingle($parameters)
    {
        return $this->queryFilterParams($parameters)->first();
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function get($id)
    {
        return $this->entity->find($id);
    }

    /**
     * @return Model
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param $parameters
     *
     * @return Builder
     */
    public function queryFilterParams($parameters)
    {
        $query = $this->entity->with($this->relations);
        if (count($parameters)) {
            $query = $this->AddFilterParams($query, $parameters);
        }

        return $query;
    }

    /**
     * @param Builder $query
     * @param array $params
     *
     * @return Builder
     */
    protected function AddFilterParams(Builder $query, array $params)
    {
        foreach ($params as $key => $value) {
            if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        return $query;
    }

    /**
     * @param $id
     * @param array $data
     *
     * @return mixed
     */
    public function update($id, array $data)
    {
        return $this->entity->whereId($id)->update($data);
    }

    /**
     * @param array $attributes
     * @param array $data
     *
     * @return Model
     */
    public function updateOrCreate(array $attributes, array $data)
    {
        return $this->entity->updateOrCreate($attributes, $data);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->entity->firstOrCreate($data);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->entity->insert($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $data = [
            'deleted_at' => now()->toDateTimeString()
        ];

        return $this->entity->whereId($id)->update($data);
    }
}
