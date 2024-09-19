<?php

namespace App\Livewire\Category;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Ver Categoría')]
class CategoryShow extends Component
{
    public function render()
    {
        return view('livewire.category.category-show');
    }
}
