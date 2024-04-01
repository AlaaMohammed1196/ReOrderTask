<?php
namespace App\Support\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait Queryable
{

    public function getAll(array $search = []): Collection
    {
        return $this->getQuery()->get();
    }

    protected function getQuery(): Builder
    {
        /** @var Model $model */
        return app($this->getModelClass());
    }
}
