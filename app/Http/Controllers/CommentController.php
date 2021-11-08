<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index(){
        $comments = $this->commentRepository->allComments() ;
        return view('comments.index', compact('comments'));
    }
    public function store(CommentRequest $request, $post_id){
        $article = $this->commentRepository->findArticle($post_id);
        $this->commentRepository->storeComment($request->validated(), $article->id );
        Session::flash('success', 'Comment added successfully');

        return redirect()->route('articles.show', [$article->id]);
    }

    public function edit($id){
        $comment = $this->commentRepository->editComment($id);
        return view('comments.edit', compact('comment'));
    }

    public function update(CommentRequest $request, $id){
        $comment = $this->commentRepository->findComment($id);
        $this->commentRepository->updateComment($request->validated(), $id);
        Session::flash('success', 'Comment updated successfully');
        return redirect()->route('articles.show', $comment->article->id);

    }

    public function destroy($id){
        $comment = $this->commentRepository->findComment($id);
        $this->commentRepository->deleteComment($id);
        Session::flash('success', 'Comment deleted successfully');

        return redirect()->route('articles.show', $comment->article->id);
    }
}
