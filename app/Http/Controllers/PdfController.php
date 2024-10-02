<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Shop;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{
    //
    public function invoice(Sale $sale)
    {

        $shop = Shop::first();

        //dd($shop);

        $pdf = Pdf::loadView('sales.invoice', compact('sale', 'shop'));
        //descargar el archivo
        //return $pdf->download('invoice.pdf');
        //abrirlo en el navegador
        return $pdf->stream('invoice.pdf');
    }
}
