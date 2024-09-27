<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Component;

class ProductRow extends Component
{
    public Product $producto;

    public function render()
    {
        return view('livewire.sale.product-row');
    }

    public function addProducto(Product $producto)
    {
        $this->dispatch('add-product', $producto);
    }
}
