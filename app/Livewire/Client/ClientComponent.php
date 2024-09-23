<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Clientes')]
class ClientComponent extends Component
{


    use WithPagination;

    //Propiedades de clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    //propiedades de modelo
    public $Id = 0;
    public $name;
    public $identificacion;
    public $telefono;
    public $email;
    public $empresa;
    public $nit;



    public function render()
    {

        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Client::count();

        $clientes = Client::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);


        return view('livewire.client.client-component',[
            'clientes' => $clientes
        ]);
    }

    public function create()
    {
        $this->Id = 0;

        $this->clean();
        $this->dispatch('open-modal', 'modalCliente');
    }


    //crear al cliente
    public function store()
    {
        // dump("crear");
        $rules = [
            'name' => 'required|min:5|max:255',
            'identificacion' => 'required|max:15|unique:clients',
            'email' => 'max:255|email|nullable',
        ];

        $this->validate($rules);

        $cliente = new Client();
        $cliente->name = $this->name;
        $cliente->identificacion = $this->identificacion;
        $cliente->email = $this->email;
        $cliente->empresa = $this->empresa;
        $cliente->nit = $this->nit;
        $cliente->save();

        $this->dispatch('close-modal', 'modalCliente');
        $this->dispatch('msg', 'Cliente creado correctamente');

        $this->clean();
    }


    public function edit(Client $cliente)
    {
        //dump($cliente);
        $this->Id = $cliente->id;
        $this->name = $cliente->name;

        $this->dispatch('open-modal', 'modalCliente');
    }


    //método encargado de la limpieza
    public function clean()
    {
        $this->Id = 0;

        $this->reset(['Id', 'name', 'identificacion', 'telefono', 'email', 'empresa', 'nit']);
        $this->resetErrorBag();
    }
}
