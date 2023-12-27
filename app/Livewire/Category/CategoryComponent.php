<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Categorías')]

class CategoryComponent extends Component
{
    //propiedades de clase
    public $totalRegistros = 0;

    //propiedades de modelo
    public $name;

    public function render()
    {
        return view('livewire.category.category-component');
    }


    public function mount()
    {
        $this->totalRegistros = Category::count();
    }

    public function store()
    {
        // dump('Crear category');
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories'
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener mínimo5 catacteres',
            'name.max' => 'El nombre no debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoría ya está en uso'

        ];

        $this->validate($rules, $messages);
    }
}
