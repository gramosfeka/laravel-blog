<?php


namespace App\Repositories;


use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleRepository extends BaseRepository
{

    public function getModel(){
        return new Article();
    }

    public function allArticles(){
       return $this->get();
    }

    public function storeArticle(array $data ){

        $image = $data['image'];
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images', $name);
        $slug = $this->getSlug($data['title']);


        $article = $this->model->create([
            'title' => $data['title'],
            'image' => $name,
            'body' => $data['body'],
            'slug' => $slug,
            'category_id' => $data['category_id'],
            'created_at' => $data['created_at'],
            'user_id' => Auth::user()->id,

        ]);

        return $article->tags()->sync($data['tags']);

    }

    public function getSlug($title){
        return $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(rand(0,1000).'-'.strtolower($title)));

    }

    public function findArticle($id)
    {
        return $this->find($id);
    }

    public function findSelectedTags($article)
    {
       foreach ($article->tags as $tag) {
          $tags_ids[] = $tag->id;
        }
       return $tags_ids;
    }


    public function updateArticle($data, $id){

        $article = $this->findArticle($id);

        if(isset($data['image'])){
            $image = $data['image'];
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images', $name);
        }else{
            $name = $data['image_old'];

        }

        $slug = $this->getSlug($data['title']);

        $article->update([
            'title' => $data['title'],
            'image' => $name,
            'body' => $data['body'],
            'slug' => $slug,
            'category_id' => $data['category_id'],
            'created_at' => $data['created_at'],
            'user_id' => Auth::user()->id,

        ]);

        return $article->tags()->sync($data['tags']);
    }

    public function deleteArticle($id){

        $article = $this->findArticle($id);

        return $article->delete();

    }

    public function approveArticle($id){

        $article = $this->findArticle($id);

        return $article->update(['status' => '1']);
    }

    public function getArticlesByCategory($id){
        return $articles = Article::where('category_id', $id)->get();


    }

}
