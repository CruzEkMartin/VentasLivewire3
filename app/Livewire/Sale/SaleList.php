<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;


#[Title('Ventas')]
class SaleList extends Component
{
    use WithPagination;

    //Propiedades de clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    //propiedades de modelo
    public $Id = 0;

    public function render()
    {

        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Sale::count();

        $sales = Sale::where('id', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.sale.sale-list', [
            'sales' => $sales
        ]);
    }

    #[On('destroySale')]
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        //devolvemos los stocks
        foreach($sale->items as $item){
            Product::find($item->product_id)->increment('stock',$item->qty);
            $item->delete();
        }

        //borramos la venta
        $sale->delete();

        //emitimos mensaje
        $this->dispatch('msg','Venta eliminada');
    }
}
