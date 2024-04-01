<?php
namespace App\Support\Repository;

 use App\Support\Traits\Crudable;
 use App\Support\Traits\Queryable;

abstract  class BaseRepository implements BaseRepositoryInterface
{
    use Crudable, Queryable;


    /**
     * Get model class
     *
     * @return string
     */


    abstract protected function getModelClass(): string;
}
