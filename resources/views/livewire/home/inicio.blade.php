<div>

    <x-card cardTitle="Bienvenid@s" cardFooter="">
        <x-slot:cardTools>
            <a href="{{ route('ventas.list') }}" class="btn btn-primary">
                <i class="fas fa-shopping-cart mr-2"></i>
                Ir a Ventas
            </a>
            <a href="{{ route('ventas.create') }}" class="btn bg-purple">
                <i class="fas fa-cart-plus mr-2"></i>
                Crear Venta
            </a>
        </x-slot:cardTools>

        {{-- row cards ventas hoy --}}

        @include('home.row_card_sales')
    </x-card>0

</div>
