<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Ver Categoría')]
class CategoryShow extends Component
{

    use WithPagination;

    //recibimos la categoria enviada por el url
    public Category $category;

    public function render()
    {
        $productos = $this->category->products()->paginate(5);
        return view('livewire.category.category-show',compact('productos'));
    }
}
