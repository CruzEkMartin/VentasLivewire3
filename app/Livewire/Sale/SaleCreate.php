<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Ventas')]
class SaleCreate extends Component
{

    use WithPagination;

    //Propiedades clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    public function render()
    {
        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Product::count();

        return view('livewire.sale.sale-create', [
            'productos' => $this->productos
        ]);
    }


    //Propidad para obtener el listado de productos
    #[Computed()]
    public function productos()
    {
        return Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);
    }


}
