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
        $model = $this->resolveModel($keyOrModel);

        if (!$model->update($data)) {
            return null;
        }

        if (!is_array($model->getKey())) {
            return $model->refresh();
        }

        return $model;
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
        $model = $this->resolveModel($keyOrModel);

        if ($this->isInstanceOfSoftDeletes($model)) {
            return !is_null($model->forceDelete());
        }

        return !is_null($model->delete());
    }
}
