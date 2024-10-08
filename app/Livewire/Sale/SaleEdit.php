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

    public $cart = 0;
    public $buscarId = null;

    public function render()
    {
        $this->getItemsToCart();

        return view('livewire.sale.sale-edit', [
            'productos' => $this->productos,
            'total' => $this->getTotal(),
            'articulos' => $this->totalArticulos()
        ]);
    }

    public function getItemsToCart()
    {
        foreach ($this->sale->items as $item) {

            //dd($item); id:13 y product_id:250
            //buscamos el producto en la db
            $producto = Product::find($item->product_id);

            dd(Cart::instance(userID())->content());

            //verificamos que no exista el item en el carrito
            $this->buscarId = $item->id;

            $existeItem = Cart::instance(userID())->search(function ($cartItem, $buscarId) {
                return $cartItem->id === $this->buscarId;
            });

            if ($existeItem) {
                return;
            } else {
                //si no existe lo agregamos
                Cart::instance(userID())->add($producto->id, $item->name, $item->qty, $item->price)->associate($producto);
            }
        }

        $this->cart = $this->getCart();
    }

    public function mount()
    {
        //$this->cart = collect();
    }

    //obtener el contenido del carrito
    public function getCart()
    {
        //dd(Cart::instance(userID())->content());
        $cart = Cart::instance(userID())->content();
        return $cart->sort();
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
