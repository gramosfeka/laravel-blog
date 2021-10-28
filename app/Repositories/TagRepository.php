<?php


namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends BaseRepository
{
    public function getModel(){
        return new Tag();
    }

    public function allTags(){
        return $this->get();
    }

    public function storeTag(array $data){
        return $this->model->create([
            'name' => $data['name']
        ]);
    }

    public function findTag($id){
        return $this->find($id);
    }

    public function updateTag($data, $id){
        $category = $this->findTag($id);
        return $category->update($data);
    }

    public function destroyTag($id){
        $tag =$this->findTag($id);
        return $tag->delete($id);
    }


}
