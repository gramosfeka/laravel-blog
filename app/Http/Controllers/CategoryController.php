<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(){
        $categories = $this->categoryRepository->allCategories();
        return view('categories.index',compact('categories'));
    }

    public function store(CategoryRequest $request){
        $this->categoryRepository->createCategory($request->validated());
        return redirect()->route('categories.index');
    }

    public function edit( $id){
        $category = $this->categoryRepository->findCategory($id);
        return view('categories.edit',compact('category'));
    }

    public function update(CategoryRequest $request, $id){
        $this->categoryRepository->updateCategory($request->validated(), $id);
        return redirect()->route('categories.index');
    }

    public function destroy($id){
        $this->categoryRepository->deleteCategory($id);
        return redirect()->route('categories.index');
    }


}
