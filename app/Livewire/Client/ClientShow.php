<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Ver Cliente')]
class ClientShow extends Component
{

    use WithPagination;

    public Client $cliente;

    public function render()
    {
        $sales = $this->cliente->sales()->paginate(5);

        return view('livewire.client.client-show',compact('sales'));
    }
}
