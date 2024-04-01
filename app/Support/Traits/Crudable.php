<?php
namespace App\Support\Traits;

use Illuminate\Database\Eloquent\Model;

trait Crudable
{
    /**
     * Create model with data
     *
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model
    {
        /** @var Model $model */
        $model = resolve($this->getModelClass());

        if (!$model->fill($data)->save()) {
            return null;
        }

        if (!is_array($model->getKey())) {
            return $model->refresh();
        }

        return $model;
    }

    /**
     * Update model
     *
     * @param Model|mixed $keyOrModel
     * @param array $data
     * @return Model|null
     * @throws RepositoryException
     */
    public function update($keyOrModel, array $data): ?Model
    {
        if (!$keyOrModel->update($data)) {
            return null;
        }

        if (!is_array($keyOrModel->getKey())) {
            return $keyOrModel->refresh();
        }

        return $keyOrModel;
    }

    /**
     * Update or create model
     *
     * @param array $attributes
     * @param array $data
     * @return Model|null
     */

    public function delete($keyOrModel): bool
    {
        return !is_null($keyOrModel->delete());
    }
}
