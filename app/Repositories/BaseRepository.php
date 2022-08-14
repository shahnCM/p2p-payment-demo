<?php

namespace App\Repositories;

use App\Contracts\RepositoryBuilder;
use App\Exceptions\ModelNotDefined;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryBuilder
{
    protected Model $model;
    protected String $modelName;

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel(): void
    {
        if (! class_exists($this->modelName)) {
            throw new ModelNotDefined();
        }
        $this->model = new $this->modelName();
    }

    public function getModel(): model
    {
        return $this->model;
    }
}
