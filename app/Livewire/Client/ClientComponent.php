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
}
