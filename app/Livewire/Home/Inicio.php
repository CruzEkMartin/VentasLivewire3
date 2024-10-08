<?php

namespace App\Livewire\Home;

use App\Models\Category;
use App\Models\Client;
use DB;
use App\Models\Item;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Inicio')]

class Inicio extends Component
{
    //Ventas Hoy
    public $ventasHoy = 0;
    public $totalVentasHoy = 0;
    public $articuloHoy = 0;
    public $productoHoy;

    //Ventas mes gráfica
    public $listTotalVentasMes = '';

    //Cajas reportes
    public $cantidadVentas = 0;
    public $totalVentas = 0;
    public $cantidadArticulos = 0;
    public $cantidadProductosVendidos = 0;

    public $cantidadProductos = 0;
    public $cantidadStock = 0;
    public $cantidadCategorias = 0;
    public $cantidadClientes = 0;

    //tablas productos mas vendidos y reciente
    public $productosMasVendidosHoy = 0;
    public $productosMasVendidosMes = 0;
    public $productosMasVendidos = 0;
    public $productosRecientes = 0;

    //mejores compradores y vendedores
    public $bestSellers = 0;
    public $bestBuyers = 0;


    public function render()
    {
        $this->sales_today();
        $this->calVentasMes();
        $this->boxes_reports();
        $this->set_productos_reports();
        $this->get_best_sellers_buyers();

        return view('livewire.home.inicio');
    }

    public function sales_today()
    {
        //ventas del día actual
        $this->ventasHoy = Sale::whereDate('fecha', date('Y-m-d'))->count();
        $this->totalVentasHoy = Sale::whereDate('fecha', date('Y-m-d'))->sum('total');
        $this->articuloHoy = Item::whereDate('fecha', date('Y-m-d'))->sum('qty');

        //quitamos el modo restrictivo de mysql
        DB::statement("SET SQL_MODE=''");
        $this->productoHoy = count(Item::whereDate('fecha', date('Y-m-d'))->groupBy('product_id')->get());
    }


    public function calVentasMes()
    {
        //total de ventas por mes del año actual
        for ($i = 1; $i <= 12; $i++) {
            $this->listTotalVentasMes .= Sale::whereMonth('fecha', '=', $i)->whereYear('fecha', '=', date('Y'))->sum('total') . ',';
        }
    }

    public function boxes_reports()
    {
        //ventas en el año actual
        $this->cantidadVentas = Sale::whereYear('fecha', '=', date('Y'))->count();
        $this->totalVentas = Sale::whereYear('fecha', '=', date('Y'))->sum('total');
        $this->cantidadArticulos = Item::whereYear('fecha', '=', date('Y'))->sum('qty');

        //quitamos el modo restrictivo de mysql
        DB::statement("SET SQL_MODE=''");
        $this->cantidadProductos = count(Item::whereYear('fecha', '=', date('Y'))->groupBy('product_id')->get());

        $this->cantidadProductos = Product::count();
        $this->cantidadStock = Product::sum('stock');
        $this->cantidadCategorias = Category::count();
        $this->cantidadClientes = Client::count();
    }

    public function productos_reports($filtrarDia = 0, $filtrarMes = 0)
    {

        $productosQuery = Item::select('items.id', 'items.name', 'items.price', 'items.image', 'items.product_id', DB::raw('sum(items.qty) as total_quantity'))
            ->groupBy('product_id')
            ->whereYear('items.fecha', date("Y"));

        //obtenemos los productos más vendidos del día
        if ($filtrarDia) {
            $productosQuery = $productosQuery->whereDate('items.fecha', date('Y-m-d'));
        }

        //obtenemos los productos más vendidos del mes
        if ($filtrarMes) {
            $productosQuery = $productosQuery->whereMonth('items.fecha', date('m'));
        }

        $productosQuery = $productosQuery->orderBy('total_quantity', 'DESC')
            ->take(5)
            ->get();

        return $productosQuery;
    }

    public function set_productos_reports()
    {
        //obtenemos los productos más vendidos del día, se manda parámetro para filtrar el día actual
        $this->productosMasVendidosHoy = $this->productos_reports(1);
        //obtenemos los productos más vendidos del mes, se manda parámetro para indicar filtro del mes actual
        $this->productosMasVendidosMes = $this->productos_reports(0, 1);
        //obtenemos los productos más vendidos del año, no se manda parámetro
        $this->productosMasVendidos = $this->productos_reports();
        //obtenemos los productos agregados recientemente
        $this->productosRecientes = Product::take(5)->orderBY('id','desc')->get();
    }

    public function best_sellers(){
        return User::select('users.id', 'users.name', 'users.admin', DB::raw('SUM(sales.total) as total'))
        ->join('sales','sales.user_id','=','users.id')
        ->whereYear('sales.fecha', date("Y"))
        ->groupBy('users.id', 'users.name')
        ->orderBy('total', 'desc')
        ->take(5)
        ->get();
    }

    public function best_buyers(){
        return Client::select('clients.id', 'clients.name', DB::raw('SUM(sales.total) as total'))
        ->join('sales','sales.client_id','=','clients.id')
        ->whereYear('sales.fecha', date("Y"))
        ->groupBy('clients.id', 'clients.name')
        ->orderBy('total', 'desc')
        ->take(5)
        ->get();
    }

    public function get_best_sellers_buyers(){
        $this->bestSellers = $this->best_sellers();
        $this->bestBuyers = $this->best_buyers();
    }
}
