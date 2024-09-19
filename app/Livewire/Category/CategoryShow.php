<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Ver Categoría')]
class CategoryShow extends Component
{

    //recibimos la categoria enviada por el url
    public Category $category;

    public function render()
    {
        return view('livewire.category.category-show');
    }
}
