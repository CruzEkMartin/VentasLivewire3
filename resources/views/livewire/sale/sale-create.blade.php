<div>
    <x-card cardTitle="Crear Venta">
        <x-slot:cardTools>

            <a href="#" class="btn btn-primary mr-2" wire:click='create'>
                <i class="fas fa-plus-circle mr-1"></i> Ir a ventas
            </a>

            <a href="#" class="btn btn-danger" wire:click='create'>
                <i class="fas fa-trash mr-1"></i> Cancelar
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
