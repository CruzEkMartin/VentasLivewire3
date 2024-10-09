<div>
    <x-card cardTitle="Editar Venta">
        <x-slot:cardTools>

            <a href="{{ route('ventas.list') }}" class="btn btn-primary btn-sm mr-2">
                <i class="fas fa-shopping-cart mr-1"></i> Ir a ventas
            </a>

            <a href="#" class="btn btn-sm btn-danger {{ isset($sale) ? 'disabled' : '' }}"   wire:click='clear'>
                <i class="fas fa-trash mr-1"></i> Cancelar Venta
            </a>

        </x-slot>

        {{-- Contenido Principal --}}
        <div class="row">

            {{-- Columna detalles venta --}}
            <div class="col-md-6">
                @include('sales.card_details')


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
