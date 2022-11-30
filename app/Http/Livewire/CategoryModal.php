<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Brand;

class CategoryModal extends Component
{
    public $category;
    protected $listeners = ['setType','findCategory'];

    protected $rules=[
        'category.name'=>'required',
        'category.code'=>'required',
    ];

    public function render()
    {
        return view('livewire.category-modal');
    }

    public function mount(){
        $category = new Category;
    }

    public function findCategory($type,$id){
        if($type=="cat") $this->category = Category::find($id);
        else if($type=="brand") $this->category = Brand::find($id);
    }

    public function setType($type){
        if($type=="cat") $this->category = new Category;
        else if($type=="brand") $this->category = new Brand;
    }

    public function store(){
        $this->validate();
        $this->category->save();
        $this->emit('showMessage','Successfully Completed');
    }
}
