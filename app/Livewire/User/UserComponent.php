<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Usuarios')]
class UserComponent extends Component
{

    use WithPagination;

    use WithFileUploads;

    //Propiedades de clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    //propiedades de modelo
    public $Id = 0;
    public $name;
    public $email;
    public $password;
    public $re_password;
    public $admin;
    public $active;
    public $image;
    public $imageModel;

    public function render()
    {

        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = User::count();

        $usuarios = User::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);


        return view('livewire.user.user-component', [
            'usuarios' => $usuarios
        ]);
    }

    public function create()
    {
        $this->Id = 0;
        $this->clean();
        $this->dispatch('open-modal', 'modalUsuario');
    }


    //crear productos
    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5',
            're_password' => 'required|same:password',
            'image' => 'image|max:1024|nullable'
        ];


        $this->validate($rules);

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->admin = $this->admin;
        $user->active = $this->active;

        $user->save();

        if ($this->image) {
            $customName = 'users/' . uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('public', $customName);
            $user->image()->create(['url' => $customName]);
        }


        $this->dispatch('close-modal', 'modalUsuario');
        $this->dispatch('msg', 'Usuario creado correctamente');

        $this->clean();
    }




    //método encargado de la limpieza
    public function clean()
    {
        $this->reset(['Id', 'name', 'email', 'password', 'admin', 'active', 'image', 'imageModel']);
        $this->resetErrorBag();
    }
}
