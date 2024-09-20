<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class ProductSearch extends Component
{
    public $search;

    public function render()
    {
        if($this->search){
            $productos = Product::where('name', 'like', '%' . $this->search . '%' )->take(5)->get();
        }else{
            $productos = collect();
        }


        return view('livewire.product.product-search', [
            'productos' => $productos
        ]);
    }
}
