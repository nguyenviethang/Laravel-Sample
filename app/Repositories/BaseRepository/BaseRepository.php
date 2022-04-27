<?php

namespace App\Repositories\BaseRepository;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    function __construct()
    {
        $this->setModel();
    }
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll($validated)
    {
        return $this->model->all();
    }
}
