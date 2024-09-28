<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class ProductRow extends Component
{
    public Product $producto;
    public $stock;
    public $stockLabel;


    //escuchamos los eventos dinamicamente para solo afectar el componente que envía el evento
    //primero se indica el evento con sus parametros y luego la función que procesará el evento
    public function getListeners()
    {
        return [
            "decrementStock.{$this->producto->id}" => "decrementStock",
            "incrementStock.{$this->producto->id}" => "incrementStock",
            "refreshProducts" => "mount",
            "devolverStock.{$this->producto->id}" => "devolverStock",
        ];
    }


    public function render()
    {
        $this->stockLabel = $this->stockLabel();

        return view('livewire.sale.product-row');
    }

    public function mount()
    {
        $this->stock = $this->producto->stock;
    }

    public function addProducto(Product $producto)
    {
        //si el stock es igual a cero salimos de la función para no seguir agregando productos
        if ($this->stock == 0) {
            return;
        }

        $this->dispatch('add-product', $producto);
        $this->stock--;
    }


    //listener para descontar el stock del listado, se emite desde  sale.SaleCreate
    #[On('decrementStock')]
    public function decrementStock()
    {
        $this->stock--;
    }

    //listener para aumentar el stock del listado, se emite desde  sale.SaleCreate
    #[On('incrementStock')]
    public function incrementStock()
    {

        if ($this->stock == $this->producto->stock - 1) {
            return;
        }

        $this->stock++;
    }


    //listener para devolver el stock del listado, se emite desde  sale.SaleCreate
    public function devolverStock($qty)
    {
        $this->stock +=  $qty;
    }

    public function stockLabel()
    {
        if ($this->stock <= $this->producto->stock_minimo) {
            return '<span class="badge badge-pill badge-danger">' . $this->stock . '</span>';;
        } else {
            return '<span class="badge badge-pill badge-success">' . $this->stock . '</span>';;
        }
    }
}
