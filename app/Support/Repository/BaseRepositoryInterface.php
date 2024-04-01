<?php
namespace App\Support\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\LazyCollection;

interface BaseRepositoryInterface
{
    /**
     * Create model with data
     *
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model;

    /**
     * Update model
     *
     * @param Model|mixed $keyOrModel
     * @param array $data
     * @return Model|null
     */
    public function update($keyOrModel, array $data): ?Model;


    /**
     * Delete model
     *
     * @param Model|mixed $keyOrModel
     * @return bool
     * @throws Exception
     */
    public function delete($keyOrModel): bool;


    /**
     * Find or fail by primary key or custom column
     *
     * @param $value
     * @param string|null $column
     * @return Model
     */
    // public function findOrFail($value, ?string $column = null): Model;

    /**
     * Get filtered collection
     *
     * @param array $search
     * @return Collection
     */
    public function getAll(): Collection;
}
