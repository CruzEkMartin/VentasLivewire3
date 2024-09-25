<?php

namespace App\Livewire\Sale;


use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Gloudemans\Shoppingcart\Facades\Cart;

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
            'productos' => $this->productos,
            'cart' => $this->getCart()
        ]);
    }


    //agregar producto al carrito
    public function addProducto(Product $producto)
    {
        // dump($producto);

        //creamos la instancia para el carrito de cada usuario
        //$userID = auth()->user()->id;

        $cartItem = Cart::instance(userID())->add($producto->id, $producto->name, 1, $producto->precio_venta);

        $cartItem->associate('Product');

        //dump(Cart::instance(userID())->content());

    }

    //obtener el contenido del carrito
    public function getCart()
    {
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
}
