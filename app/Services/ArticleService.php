<?php
namespace App\Services;

use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\ArticleServiceInterface;
use App\Support\Service\BaseCrudService;

class ArticleService extends BaseCrudService implements ArticleServiceInterface
{

    protected function getRepositoryClass(): string
    {
        return ArticleRepositoryInterface::class;
    }

}
