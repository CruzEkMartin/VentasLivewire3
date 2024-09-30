<?php

namespace App\Livewire\Sale;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;

class Cliente extends Component
{
    public $Id = 0;
    public $client = 1;
    public $nameClient;

    //propiedades de modelo
    public $name;
    public $identificacion;
    public $telefono;
    public $email;
    public $empresa;
    public $nit;


    public function render()
    {
        return view('livewire.sale.cliente', [
            'clients' => Client::all(),
            'nameClient' => $this->nameClient($this->client)

        ]);
    }

    //escucha el evento emitido por el select2
    #[On('client_id')]
    public function client_id($id=1){
        $this->client = $id;
        $this->nameClient($id);
    }

    public function mount(){
        $this->nameClient($this->client);
    }


    public function nameClient($id)
    {
        $findClient = Client::find($id);

        $this->nameClient = $findClient->name;
    }



    public function openModal()
    {
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
        $cliente->telefono = $this->telefono;
        $cliente->email = $this->email;
        $cliente->empresa = $this->empresa;
        $cliente->nit = $this->nit;
        $cliente->save();

        $this->dispatch('close-modal', 'modalCliente');
        $this->dispatch('msg', 'Cliente creado correctamente');

        $this->dispatch('client_id', $cliente->id);

        $this->clean();
    }

    //método encargado de la limpieza
    public function clean()
    {
        $this->Id = 0;

        $this->reset(['Id', 'name', 'identificacion', 'telefono', 'email', 'empresa', 'nit']);
        $this->resetErrorBag();
    }
}
