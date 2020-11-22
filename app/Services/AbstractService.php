<?php

namespace App\Services;

use App\Repositories\AbstractRepository as Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;

class AbstractService
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var Model
     */
    protected $entity;

    /**
     * @var array
     */
    public $entityFilters = [];

    /**
     * @var MessageBag
     */
    protected $notificationsBag;

    const TIME_ADJUSTMENT = 10800;

    /**
     * Collect the notification messages for the entity(s).
     *
     * @return MessageBag
     */
    public function getNotificationsBag()
    {
        if (!$this->notificationsBag) {
            $this->notificationsBag = new MessageBag();
        }

        return $this->notificationsBag;
    }

    /**
     * @param array $entityFilters
     *
     * @return $this
     */
    public function setEntityFilters($entityFilters = [])
    {
        $this->entityFilters = $entityFilters;

        return $this;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAll()
    {
        return $this->repository->getAll($this->entityFilters);
    }

    /**
     * @param $id
     * @return Collection
     */
    public function get($id)
    {
        return $this->repository->get($id);
    }

    /**
     * @param $params
     *
     * @return Model|null|static
     */
    public function getSingle($params)
    {
        return $this->repository->getSingle($params);
    }

    /**
     * @return array
     */
    public function getCrudLookUps()
    {
        return $this->repository->getCrudLookUps();
    }

    /**
     * @return Repository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function cleanInputData(array $data)
    {
        return collect($data)->except(['_method', '_token'])->all();
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    public function update($id, $data)
    {
        $data = $this->cleanInputData($data);

        return $this->repository->update($id, $data);
    }

    /**
     * @param array $attributes
     * @param array $data
     *
     * @return Model
     */
    public function updateOrCreate(array $attributes, array $data)
    {
        $data = $this->cleanInputData($data);

        return $this->repository->updateOrCreate($attributes, $data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function create($data)
    {
        $data = $this->cleanInputData($data);

        return $this->repository->create($data);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function insert($data)
    {
        return $this->repository->insert($data);
    }
}
