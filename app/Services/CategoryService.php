<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends Services {

    public function __construct()
    {
        parent::__construct(new Category());
    }

    public function delete(Model $category) {

        if($category->transactions->count()) {
            $this->_message = 'Não é possível excluir a categoria <b>'.$category->name.'</b>. Ela está atrelada a um ou mais lançamentos!';
            return false;
        }

        return $this->delete($category);

    }

    public function listCategories() {
        return Category::select(['id', 'name'])->where('category_id', 0)->orWhereNull('category_id')->get()->toArray();
    }

    public function toSelectBox($fields = [])
    {
        $data =  Category::with(['subcategories'])->where('category_id', 0)->orderBy('name')->get();

        $return = [];
        
        foreach($data as $item) {


            foreach($item->subcategories as $cat) {

            
                $return[] = [
                    'id'   => $cat->id,
                    'name' => $item->name . ' - '. $cat->name
                ];
            }
        }

        return $return;
    }

    public function listToDatatable() {
        $data = [];
        $categories = $this->all();

        

        foreach($categories as $item) {

            $link = '<a href="%s"> &nbsp;&nbsp; %s</a>';

            if($item->category_id === 0 || empty($item->category_id)) {
                $link = '<a href="%s"><b>%s</b></a>';
            }

            $status = '<i class="fa fa-thumbs-up text-success" aria-hidden="true"></i>';

            if(!$item->enabled) {
                $status = '<i class="fa fa-thumbs-down text-danger" aria-hidden="true"></i>';
            } 

            $data[] = [
                'name' => sprintf($link, route('category.show', $item), $item->name),
                'parent' => $item->parent->name ?? $item->name,
                'status' => $status . ' ' . $item->status
            ];
        }

        return json_encode(['data' => $data]);
    }


}