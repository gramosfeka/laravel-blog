<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $articleRepository;
    private $categoryRepository;

    public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;

        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $categories = $this->categoryRepository->allCategories();
        $articles = $this->articleRepository->allArticles();
        return view('home', compact('categories', 'articles'));
    }


    public function category($id){
        $articles = $this->articleRepository->getArticlesByCategory($id);
        $categories = $this->categoryRepository->allCategories();

        return view('home', compact('articles','categories'));

    }
}
