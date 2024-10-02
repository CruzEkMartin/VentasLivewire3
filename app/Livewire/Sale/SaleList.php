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

    public $totalVentas = 0;
    public $dateInicio;
    public $dateFinal;

    //propiedades de modelo
    public $Id = 0;

    public function render()
    {

        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Sale::count();

        $salesQuery = Sale::where('id', 'like', '%' . $this->search . '%');

        if ($this->dateInicio && $this->dateFinal) {
            $salesQuery = $salesQuery->whereBetween('fecha',[$this->dateInicio, $this->dateFinal]);

            $this->totalVentas = $salesQuery->sum('total');
        } else {
            $this->totalVentas = Sale::sum('total');
        }

        $sales = $salesQuery
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
        foreach ($sale->items as $item) {
            Product::find($item->product_id)->increment('stock', $item->qty);
            $item->delete();
        }

        //borramos la venta
        $sale->delete();

        //emitimos mensaje
        $this->dispatch('msg', 'Venta eliminada');
    }

    //recibe las fechas del datepicker
    #[On('setDates')]
    public function setDates($fechaInicio, $fechaFinal)
    {
        //dump($fechaInicio, $fechaFinal);

        $this->dateInicio = $fechaInicio;
        $this->dateFinal = $fechaFinal;
    }
}
