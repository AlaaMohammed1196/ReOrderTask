<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Interfaces\ArticleServiceInterface;
use App\Models\Article;
use App\Support\Traits\GeneralTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
     Use GeneralTrait;

     private ArticleServiceInterface $articleServiceInterface;

       public function __construct(ArticleServiceInterface $articleServiceInterface)
       {
           $this->articleServiceInterface = $articleServiceInterface;
       }

    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $articles=ArticleResource::collection($this->articleServiceInterface->getAll());
        return $this->returnDate($articles, 'List Articles');

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $articleRequest):JsonResponse
    {
        $this->articleServiceInterface->create($articleRequest->all());
        return $this->returnSuccessMessage('Created Successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $articleRequest,Article $article) :JsonResponse
    {
        $this->articleServiceInterface->update($article,$articleRequest->all());
        return $this->returnSuccessMessage('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->articleServiceInterface->delete($article);
        return $this->returnSuccessMessage('Deleted Successfully');
    }
}
