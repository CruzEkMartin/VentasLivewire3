<div>
    <x-card cardTitle="Crear Venta">
        <x-slot:cardTools>

            <a href="{{ route('ventas.list') }}" class="btn btn-primary btn-sm mr-2">
                <i class="fas fa-shopping-cart mr-1"></i> Ir a ventas
            </a>

            <a href="#" class="btn btn-sm btn-danger" wire:click='clear'>
                <i class="fas fa-trash mr-1"></i> Cancelar
            </a>

        </x-slot>

        {{-- Contenido Principal --}}
        <div class="row">

            {{-- Columna detalles venta --}}
            <div class="col-md-6">
                @include('sales.card_details')

                {{-- Columna para el pago --}}
                @include('sales.card_pago')

                {{-- Card Cliente --}}
                @livewire('sale.cliente')
            </div>




            {{-- Columna Productos --}}
            <div class="col-md-6">
                @include('sales.list_products')
            </div>

        </div>


        <x-slot:cardFooter>

        </x-slot>
    </x-card>

</div>
