<?php

namespace App\Livewire\Category;

use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Categorias')]

class CategoryComponent extends Component
{
    public function render()
    {
        return view('livewire.category.category-component');
    }
}
