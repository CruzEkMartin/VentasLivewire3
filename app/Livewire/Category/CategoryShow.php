<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

#[Title('Ver categoría')]
class CategoryShow extends Component
{
    public Category $category;

    public function render()
    {
        return view('livewire.category.category-show');
    }
}
