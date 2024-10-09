<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Gloudemans\Shoppingcart\Facades\Cart;

#[Title('Ventas')]
class SaleEdit extends Component
{
    public Sale $sale;

    use WithPagination;

    //Propiedades clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    public $buscaId = null;

    public function render()
    {

        return view('livewire.sale.sale-edit', [
            'productos' => $this->productos, //funcion computada de productos
            'total' => $this->getTotal(),
            'cart' => $this->getCart(),
            'totalArticulos' => $this->totalArticulos(),
            'totalProductos' => $this->totalProductos()
        ]);
    }


    public function mount()
    {
        //cargamos la venta
        $this->getItemsToCart();
    }


    public function editSale(){
        dd('editar');
    }

    //agregar producto al carrito
    #[On('add-product')]
    public function addProducto(Product $producto)
    {
        Cart::instance(userID())->add($producto->id, $producto->name, 1, $producto->precio_venta)->associate($producto);
    }


    //decrementar cantidad
    public function decrementar($rowId)
    {
        //dd($rowId);

        $item =  Cart::instance(userID())->get($rowId);

        if ($item->qty > 1) {
            Cart::instance(userID())->update($rowId, $item->qty - 1);

            //emitimos un evento para disminuir el stock del listado, se escucha en Sales.ProductoRow
            $this->dispatch("incrementStock.{$item->id}");
        }
    }

    //decrementar cantidad
    public function incrementar($rowId)
    {
        //dd($rowId);
        $item =  Cart::instance(userID())->get($rowId);
        //dd($item);

        Cart::instance(userID())->update($rowId, $item->qty + 1);

        //emitimos un evento para disminuir el stock del listado, se escucha en Sales.ProductoRow
        $this->dispatch("decrementStock.{$item->id}");
    }


    //eliminar producto
    public function removeItem($rowId, $qty)
    {

        $item =  Cart::instance(userID())->get($rowId);

        Cart::instance(userID())->remove($rowId);

        $this->dispatch("devolverStock.{$item->id}", $qty);
    }


    public function getItemsToCart()
    {

        // Limpiar el carrito antes de cargar la venta
        Cart::instance(userID())->destroy();

        //recorremos cada producto de la venta y lo metemos al carrito
        foreach ($this->sale->items as $item) {

            //buscamos el producto en la db
            $producto = Product::find($item->product_id);

            // Cart::instance(userID())->add($producto->id, $producto->name, $item->qty, $item->price)->associate($producto);

            // Busca el ítem en el carrito
            $this->buscaId = $producto->id;

            $existingItem = Cart::instance(userID())->search(function ($cartItem) {
                return $cartItem->id === $this->buscaId; // Cambia el criterio si es necesario
            })->first();

            //si existe no hacemos nada, si no existe lo agregamos
            if ($existingItem) {
                return;
            } else {
                Cart::instance(userID())->add($producto->id, $producto->name, $item->qty, $item->price)->associate($producto);
            }
        }

        //dd(Cart::instance(userID())->content());


    }


    //obtener el contenido del carrito
    public function getCart()
    {
        $cart = Cart::instance(userID())->content()->sortByDesc(function ($item) {
            return $item->id;
        });
        return $cart; //->sort('id');

        // //convertimos en un array simple para poderlo mostrar y no salga error Property type not supported in Livewire for property:
        // $cart = Cart::instance(userID())->content()->map(function ($item) {
        //     return [
        //         'rowId' => $item->rowId,
        //         'id' => $item->id,
        //         'name' => $item->name,
        //         'qty' => $item->qty,
        //         'price' => $item->price,

        //     ];
        // })->toArray();
        // return $cart;

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

    //total de productos
    public function totalProductos()
    {
        return Cart::instance(userID())->content()->count(false);
    }

    public function getTotal()
    {
        //dd(Cart::instance(userID())->tax());
        Cart::instance(userID())->setGlobalTax(0);
        return Cart::instance(userID())->total(2, '.', '');
    }
}
