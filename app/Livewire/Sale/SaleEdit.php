<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Gloudemans\Shoppingcart\Facades\Cart;

#[Title('Editar Venta')]
class SaleEdit extends Component
{
    public Sale $sale;

    use WithPagination;

    //Propiedades clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    public $cart;

    public function render()
    {
        return view('livewire.sale.sale-edit',[
            'productos' => $this->productos,
            'total' => $this->getTotal(),
            'articulos' => $this->totalArticulos()
        ]);
    }

    public function mount(){
        $this->cart = collect();
    }


    //Propidad para obtener el listado de productos
    #[Computed()]
    public function productos()
    {
        return Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);
    }

    //total de articulos
    public function totalArticulos()
    {
        return Cart::instance(userID())->count(false);
    }

    public function getTotal()
    {
        //dd(Cart::instance(userID())->tax());
        Cart::instance(userID())->setGlobalTax(0);
        return Cart::instance(userID())->total(2, '.', '');
    }


}
