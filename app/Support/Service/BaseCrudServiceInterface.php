<?php
namespace App\Support\Service;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

interface BaseCrudServiceInterface
{
    /**
     * Get filtered results
     *
     * @return EloquentCollection
     */
    public function getAll(): EloquentCollection;

    /**
     * Create model
     *
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model;

    /**
     * Update model
     *
     * @param mixed $keyOrModel
     * @param array $data
     * @return Model|null
     */
    public function update($keyOrModel, array $data): ?Model;

    /**
     * Delete model
     *
     * @param mixed $keyOrModel
     * @return bool
     * @throws Exception
     */
    public function delete($keyOrModel): bool;
}
