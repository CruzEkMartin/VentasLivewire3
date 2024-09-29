<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use Livewire\Attributes\Reactive;

class Currency extends Component
{
    //le ponemos reactive a la variable $total para que se actualice cuando cambie el valor de total desde el componente padre (SaleCreate.php)
    #[Reactive]
    public $total;
    public $valores = [];

    public function render()
    {
        return view('livewire.sale.currency');
    }

    public function mount()
    {
        $this->valores = [1000, 2000, 5000, 10000, 20000, 50000, 100000];
    }

    public function setPago($valor)
    {
        //enviamos un evento al componente padre
        $this->dispatch('setPago', $valor);
        $this->dispatch('close-modal', 'modalCurrency');
    }


    public function openModal()
    {
        $this->dispatch('open-modal', 'modalCurrency');
    }
}
