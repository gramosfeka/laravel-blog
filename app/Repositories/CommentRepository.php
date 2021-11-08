<?php


namespace App\Repositories;


use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentRepository extends BaseRepository
{
    public function getModel(){
        return new Comment();
    }

    public function allComments(){
        return Comment::orderBy('created_at', 'desc')->get();
    }

    public function findArticle($id){
        $article = Article::find($id);
        return $article;
    }

    public function storeComment(array $data, $post_id){
        $article = $this->findArticle($post_id);
        $comment = $this->model->create([
            'comment' => $data['comment'],
            'user_id' => Auth::user()->id,
            'article_id' => $article->id,
        ]);

         return $comment->article()->associate($article);
    }


    public function findComment($id){
        $comment =  $this->find($id);
        return $comment;
    }

    public function editComment($id){
        $comment =  $this->find($id);
        Gate::authorize('edit-comment', $comment);
        return $comment;
    }


    public function updateComment($data, $id){
        $comment = $this->findComment($id);
        Gate::authorize('edit-comment', $comment);

        return $comment->update($data);
    }

    public function deleteComment($id){
        $comment = $this->findComment($id);
        Gate::authorize('edit-comment', $comment);
        return $comment->delete();

    }
}
