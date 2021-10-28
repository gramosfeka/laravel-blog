<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    private $articleRepository;
    private $categoryRepository;
    private $tagRepository;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index(){
        $articles = $this->articleRepository->allArticles();
        return view('articles.index', compact('articles'));
    }

    public function create(){
        $categories = $this->categoryRepository->allCategories();
        $tags = $this->tagRepository->allTags();
        return view('articles.create', compact('categories', 'tags'));
    }

    public function store(ArticleRequest $request){
        $this->articleRepository->storeArticle($request->validated());
        Session::flash('success', 'Article created successfully');

        return redirect()->route('articles.index');
    }


    public function show($id){
        $article = $this->articleRepository->findArticle($id);

        return view('articles.show', compact('article'));
    }

    public function edit($id){

        $article = $this->articleRepository->findArticle($id);
        $tags_ids = $this->articleRepository->findSelectedTags($article);
        $tags = $this->tagRepository->allTags();
        $categories = $this->categoryRepository->allCategories();


        return view('articles.edit', compact('categories', 'tags', 'article','tags_ids'));
    }

    public function update(UpdateArticleRequest $request, $id){
        $this->articleRepository->updateArticle($request->validated(), $id);
        return redirect()->route('articles.index');
    }


    public function destroy($id){
        $this->articleRepository->deleteArticle($id);
        return redirect()->route('articles.index');
    }

    public function approve($id){
        $this->articleRepository->approveArticle($id);
        return redirect()->route('articles.index');
    }




}
