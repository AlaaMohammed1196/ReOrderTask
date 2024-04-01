<?php
namespace App\Repositories;


use App\Models\Article;
use App\Support\Repository\BaseRepository;
use App\interfaces\ArticleRepositoryInterface;
use App\Support\Repository\Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return  Article::class;
    }
}
