<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;


#[Title('Categorias')]

class CategoryComponent extends Component
{

    use WithPagination;

    //Propiedades de clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    //propiedades de modelo
    public $name;
    public $Id = 0;

    public function render()
    {

        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Category::count();

        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.category.category-component', [
            'categories' => $categories
        ]);
    }

    public function mount() {}

    public function create()
    {
        $this->Id = 0;
        $this->reset(['name']);
        $this->resetErrorBag();
        $this->dispatch('open-modal', 'modalCategoria');
    }

    //crear la categoría
    public function store()
    {
        // dump("crear");
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories'
        ];
        $messages = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.min' => 'El nombre debe tener un mínimo de 5 caracteres',
            'name.max' => 'El nombre no debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoría ya está en uso',
        ];

        $this->validate($rules, $messages);

        $category = new Category();
        $category->name = $this->name;
        $category->save();

        $this->dispatch('close-modal', 'modalCategoria');
        $this->dispatch('msg', 'Categoría creada correctamente');

        $this->reset(['name']);
    }


    public function edit(Category $category)
    {
        //dump($category);
        $this->Id = $category->id;
        $this->name = $category->name;

        $this->dispatch('open-modal', 'modalCategoria');
    }

    public function update(Category $category)
    {
        //dump($category);
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories,id,' . $this->Id
        ];
        $messages = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.min' => 'El nombre debe tener un mínimo de 5 caracteres',
            'name.max' => 'El nombre no debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoría ya está en uso',
        ];

        $this->validate($rules, $messages);

        $category->name = $this->name;
        $category->update();

        $this->dispatch('close-modal', 'modalCategoria');
        $this->dispatch('msg', 'Categoría actualizada correctamente');

        $this->reset(['name']);
    }

    #[On('destroyCategory')]
    public function destroy($id)
    {
        //dump($id);
        $category = Category::findOrfail($id);
        //dump($category);
        $category->delete();

        $this->dispatch('msg', 'La Categoría ha sido eliminada correctamente');

    }
}
