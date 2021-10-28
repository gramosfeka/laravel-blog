<?php


namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function getModel(){
        return new Category();
    }

    public function allCategories()
    {
        return $this->get();
    }

    public function createCategory(array $data)
    {
        return $this->model->create([
            'name' => $data['name']
        ]);
    }

    public function findCategory($id)
    {
        return $this->find($id);
    }

    public function updateCategory($data, $id){

        $category = $this->findCategory($id);

        return $category->update($data);
    }


    public function deleteCategory($id){

        $category = $this->findCategory($id);

        return $category->delete();

    }

}
