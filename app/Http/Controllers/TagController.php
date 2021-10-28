<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class TagController extends Controller
{
    private $tagRepository;
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index(){
       $tags = $this->tagRepository->allTags();
       return view('tags.index',compact('tags'));
    }

    public function store(TagRequest $request){
        $this->tagRepository->storeTag($request->validated());
        return redirect()->route('tags.index');


    }

    public function edit($id){
        $tag = $this->tagRepository->findTag($id);
        return view('tags.edit',compact('tag'));

    }

    public function update(TagRequest $request, $id){
        $this->tagRepository->updateTag($request->validated(), $id);
        return redirect()->route('tags.index');

    }

    public function destroy($id){
        $this->tagRepository->destroyTag($id);
        return redirect()->route('tags.index');

    }
}
