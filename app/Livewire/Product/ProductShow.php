<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Ver Productos')]
class ProductShow extends Component
{

    public Product $producto;

    public function render()
    {
        return view('livewire.product.product-show');
    }
}
