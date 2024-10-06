<?php

namespace App\Livewire\Home;

use DB;
use App\Models\Item;
use App\Models\Sale;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Inicio')]

class Inicio extends Component
{
    public $ventasHoy =0;
    public $totalVentasHoy=0;
    public $articuloHoy=0;
    public $productoHoy;

    public function render()
    {
        $this->sales_today();

        return view('livewire.home.inicio');
    }

    public function sales_today(){
        $this->ventasHoy = Sale::whereDate('fecha',date('Y-m-d'))->count();
        $this->totalVentasHoy = Sale::whereDate('fecha',date('Y-m-d'))->sum('total');
        $this->articuloHoy = Item::whereDate('fecha',date('Y-m-d'))->sum('qty');
        DB::statement("SET SQL_MODE=''");
        $this->productoHoy =count(Item::whereDate('fecha',date('Y-m-d'))->groupBy('product_id')->get());
    }



}
