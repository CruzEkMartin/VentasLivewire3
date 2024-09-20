<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;

#[Title('Productos')]
class ProductComponent extends Component
{

    use WithPagination;

    use WithFileUploads;

    //Propiedades de clase
    public $search = '';
    public $totalRegistros = 0;
    public $cant = 5;

    //propiedades de modelo
    public $name;
    public $Id = 0;
    public $descripcion;
    public $precio_compra;
    public $precio_venta;
    public $stock = 0;
    public $stock_minimo = 10;
    public $codigo_barras;
    public $fecha_vencimiento;
    public $active = 1;
    public $category_id;
    public $image;
    public $imageModel;

    public function render()
    {


        if ($this->search != '') {
            $this->resetPage();
        }

        $this->totalRegistros = Product::count();

        $productos = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);


        return view('livewire.product.product-component', [
            'productos' => $productos
        ]);
    }

    #[Computed()]
    public function categories()
    {
        return Category::all();
    }

    public function create()
    {
        $this->Id = 0;
        $this->clean();
        $this->dispatch('open-modal', 'modalProducto');
    }

    //crear productos
    public function store()
    {
        // dump("crear");
        $rules = [
            'name' => 'required|min:5|max:255|unique:products',
            'descripcion' => 'max:255',
            'precio_compra' => 'numeric|nullable',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_minimo' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',
        ];


        $this->validate($rules);

        $product = new Product();
        $product->name = $this->name;
        $product->descripcion = $this->descripcion;
        $product->precio_compra = $this->precio_compra;
        $product->precio_venta = $this->precio_venta;
        $product->stock = $this->stock;
        $product->stock_minimo = $this->stock_minimo;
        $product->codigo_barras = $this->codigo_barras;
        $product->fecha_vencimiento = $this->fecha_vencimiento;
        $product->active  = $this->active;
        $product->category_id = $this->category_id;
        $product->save();

        if ($this->image) {
            $customName = 'products/' . uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('public', $customName);
            $product->image()->create(['url' => $customName]);
        }


        $this->dispatch('close-modal', 'modalProducto');
        $this->dispatch('msg', 'Producto creado correctamente');

        $this->clean();
    }

    public function edit(Product $producto)
    {
        //dump($category);
        $this->clean();

        $this->Id = $producto->id;
        $this->name = $producto->name;
        $this->descripcion = $producto->descripcion;
        $this->precio_compra = $producto->precio_compra;
        $this->precio_venta = $producto->precio_venta;
        $this->stock = $producto->stock;
        $this->stock_minimo = $producto->stock_minimo;
        $this->imageModel = $producto->imagen;
        $this->codigo_barras = $producto->codigo_barras;
        $this->fecha_vencimiento = $producto->fecha_vencimiento;
        $this->active = $producto->active;
        $this->category_id = $producto->category_id;

        $this->dispatch('open-modal', 'modalProducto');
    }


    public function update(Product $producto)
    {
        //dump($category);
        $rules = [
            'name' => 'required|min:5|max:255|unique:products,id,' . $this->Id,
            'descripcion' => 'max:255',
            'precio_compra' => 'numeric|nullable',
            'precio_venta' => 'required|numeric',
            'stock' => 'required|numeric',
            'stock_minimo' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',
        ];

        $this->validate($rules);

        $producto->name = $this->name;
        $producto->descripcion = $this->descripcion;
        $producto->precio_compra = $this->precio_compra;
        $producto->precio_venta = $this->precio_venta;
        $producto->stock = $this->stock;
        $producto->stock_minimo = $this->stock_minimo;
        //$producto->imagen = $this->imageModel ;
        $producto->codigo_barras = $this->codigo_barras;
        $producto->fecha_vencimiento = $this->fecha_vencimiento;
        $producto->active = $this->active;
        $producto->category_id = $this->category_id;
        $producto->update();

        if ($this->image) {
            if ($producto->image != null) {
                Storage::delete('public/' . $producto->image->url);
                $producto->image()->delete();
            }
        }


        $customName = 'products/' . uniqid() . '.' . $this->image->extension();
        $this->image->storeAs('public', $customName);
        $producto->image()->create(['url' => $customName]);


        $this->dispatch('close-modal', 'modalProducto');
        $this->dispatch('msg', 'Producto actualizado correctamente');

        $this->clean();
    }


    //método encargado de la limpieza
    public function clean()
    {
        $this->reset(['Id', 'name', 'descripcion', 'precio_compra', 'precio_venta', 'stock', 'stock_minimo', 'codigo_barras', 'fecha_vencimiento', 'active', 'category_id', 'image']);
        $this->resetErrorBag();
    }
}
