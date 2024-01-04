<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Categorías')]

class CategoryComponent extends Component
{
    //para la paginacion en livewire
    use WithPagination;

    //propiedades de clase
    public $search = '';
    public $totalRegistros = 0;
    public $cantRegistros = 5;

    //propiedades de modelo, es el que se enlaza con el componente blade
    public $name;
    public $categoryId; //no se puede usar la palabra id porque está reservada para livewire

    public function render()
    {
        //para aplicar busqueda en cualquier página seleccionada
        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Category::count();

        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderby('id', 'desc')
            ->paginate($this->cantRegistros);
        //$categories = collect();

        return view('livewire.category.category-component', [
            'categories' => $categories
        ]);
    }


    public function mount()
    {
    }

    public function create()
    {
        //limpiamos el componente input del modal
        $this->reset(['name']);
        $this->categoryId = 0;
        //limpiar los errrores de validacion
        $this->resetErrorBag();
        //mandamos evento para abrir el modal junto con el id del modal a abrir
        $this->dispatch('open-modal', 'modalCategory');
    }

    public function store()
    {
        // dump('Crear category');
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories'
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener mínimo 5 catacteres',
            'name.max' => 'El nombre no debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoría ya está en uso'

        ];

        $this->validate($rules, $messages);

        $category = new Category();
        $category->name = $this->name;
        $category->save();

        //mandamos evento para cerrar el modal junto con el id del modal a cerrar
        $this->dispatch('close-modal', 'modalCategory');

        //mandamos evento para indicar que se guardo correctamente
        $this->dispatch('msg', 'Categoria creada correctamente');

        //limpiamos el componente input del modal
        $this->reset(['name']);
    }

    public function edit(Category $category)
    {
        $this->categoryId = $category->id;
        $this->name = $category->name;

        //mandamos evento para abrir el modal junto con el id del modal a abrir
        $this->dispatch('open-modal', 'modalCategory');
    }

    public function update(Category $category)
    {
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories,id,' . $this->categoryId
        ];
        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener mínimo 5 catacteres',
            'name.max' => 'El nombre no debe superar los 255 caracteres',
            'name.unique' => 'El nombre de la categoría ya está en uso'

        ];

        $this->validate($rules, $messages);

        $category->name = $this->name;
        $category->update();

        //mandamos evento para cerrar el modal junto con el id del modal a cerrar
        $this->dispatch('close-modal', 'modalCategory');

        //mandamos evento para indicar que se actualizó correctamente
        $this->dispatch('msg', 'Categoria actualizada correctamente');

        //limpiamos el componente input del modal
        $this->reset(['name']);
    }


    #[On('destroyCategory')]
    public function destroy($id)
    {

        dump($id);
    }
}
