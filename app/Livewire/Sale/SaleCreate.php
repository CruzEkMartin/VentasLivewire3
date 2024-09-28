<?php

namespace App\Livewire\Sale;


use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
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

    // public function mount()
    // {
    //     Cart::instance(userID())->destroy();
    //     //$this->updateCart();
    // }


    public function render()
    {
        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Product::count();



        return view('livewire.sale.sale-create', [
            'productos' => $this->productos,
            'cart' => $this->getCart(),
            'total' => $this->getTotal(),
            'articulos' => $this->totalArticulos()
        ]);
    }


    //agregar producto al carrito
    #[On('add-product')]
    public function addProducto(Product $producto)
    {
        // dump($producto);

        //creamos la instancia para el carrito de cada usuario
        //$userID = auth()->user()->id;

        Cart::instance(userID())->add($producto->id, $producto->name, 1, $producto->precio_venta)->associate($producto);
    }

    //obtener el contenido del carrito
    public function getCart()
    {
        //dd(Cart::instance(userID())->content());
        $cart = Cart::instance(userID())->content();
        return $cart->sort();
    }

    //devolver total
    public function getTotal()
    {
        //dd(Cart::instance(userID())->tax());
        Cart::instance(userID())->setGlobalTax(0);
        return Cart::instance(userID())->total(2, '.', '');
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
    public function removeItem($rowId)
    {
        Cart::instance(userID())->remove($rowId);
    }

    //limpiar el carrito
    public function clear()
    {
        Cart::instance(userID())->destroy();
        $this->dispatch('msg', 'Venta cancelada');
    }

    //total de articulos
    public function totalArticulos()
    {
        return Cart::instance(userID())->count(false);
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
