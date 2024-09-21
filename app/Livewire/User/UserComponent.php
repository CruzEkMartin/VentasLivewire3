<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

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
    public $admin = true;
    public $active = true;
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


    public function edit(User $usuario)
    {
        //dump($category);
        $this->clean();

        $this->Id = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->admin = $usuario->admin ? true : false;
        $this->active = $usuario->active ? true : false;
        $this->imageModel = $usuario->image ? $usuario->image->url : null ;

        $this->dispatch('open-modal', 'modalUsuario');
    }



    public function update(User $usuario)
    {
        //dump($category);
        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users,id,'.$this->Id,
            'password' => 'min:5',
            're_password' => 'same:password',
            'image' => 'image|max:1024|nullable'
        ];

        $this->validate($rules);

        $usuario->name = $this->name;
        $usuario->email = $this->email;
        $usuario->admin = $this->admin;
        $usuario->active = $this->active;

        if($this->password){
            $usuario->password = $this->password;
        }

        $usuario->update();

        if ($this->image) {
            if ($usuario->image != null) {
                Storage::delete('public/' . $usuario->image->url);
                $usuario->image()->delete();
            }
        }

        $customName = 'users/' . uniqid() . '.' . $this->image->extension();
        $this->image->storeAs('public', $customName);
        $usuario->image()->create(['url' => $customName]);


        $this->dispatch('close-modal', 'modalUsuario');
        $this->dispatch('msg', 'Usuario actualizado correctamente');

        $this->clean();
    }


    #[On('destroyUsuario')]
    public function destroy($id)
    {
        //dump($id);
        $usuario = User::findOrfail($id);
        //dump($category);usuario

        if ($usuario->image != null) {
            Storage::delete('public/' . $usuario->image->url);
            $usuario->image()->delete();
        }

        $usuario->delete();

        $this->dispatch('msg', 'El Usuario ha sido eliminada correctamente');
    }



    //método encargado de la limpieza
    public function clean()
    {
        $this->reset(['Id', 'name', 'email', 'password','re_password', 'admin', 'active', 'image', 'imageModel']);
        $this->resetErrorBag();
    }
}
