<?php
namespace Aop\Service;

use App\interfaces\ArticleRepositoryInterface;
use App\interfaces\ArticleServiceInterface;
use App\Support\Repository\BaseCrudService;

class ServiceArticle extends BaseCrudService implements ArticleServiceInterface
{

    protected function getRepositoryClass(): string
    {
        return ArticleRepositoryInterface::class;
    }
}
