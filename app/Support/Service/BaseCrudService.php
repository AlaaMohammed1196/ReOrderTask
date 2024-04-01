<?php
namespace App\Support\Repository;

use App\Support\Service\BaseCrudServiceInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseCrudService implements  BaseCrudServiceInterface
{

    protected $repository;

    public function __construct()
    {
        $this->repository=$this->getRepositoryClass();
    }

    /**
     * Get all records as collection
     *
     * @return EloquentCollection
     */
    public function getAll(): EloquentCollection
    {
        return $this->repository->getAll($search);
    }

    /**
     * Create model
     *
     * @param array $data
     * @return Model|null
     * @throws ServiceException
     */
    public function create(array $data): ?Model
    {
        if (is_null($model = $this->repository->create($data))) {
            throw new ServiceException('Error while creating model');
        }

        return $model;
    }

    /**
     * Update model
     *
     * @param $keyOrModel
     * @param array $data
     * @return Model|null
     */
    public function update($keyOrModel, array $data): ?Model
    {
        return $this->repository->update($keyOrModel, $data);
    }

    /**
     * Delete model
     *
     * @param $keyOrModel
     * @return bool
     * @throws Exception
     */
    public function delete($keyOrModel): bool
    {
        if (!$this->repository->delete($keyOrModel)) {
            throw new ServiceException('Error while deleting model');
        }

        return true;
    }

    abstract protected function getRepositoryClass(): string;

}
