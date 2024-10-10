<div>

    <x-card cardTitle="Bienvenid@s" cardFooter="">
        <x-slot:cardTools>
            @if (isAdmin())
            <a href="{{ route('ventas.list') }}" class="btn btn-primary">
                <i class="fas fa-shopping-cart mr-2"></i>
                Ir a Ventas
            </a>
            @endif

            <a href="{{ route('ventas.create') }}" class="btn bg-purple">
                <i class="fas fa-cart-plus mr-2"></i>
                Crear Venta
            </a>
        </x-slot:cardTools>

        {{-- row cards ventas hoy --}}

        @include('home.row_card_sales')

        @if(isAdmin())
        {{-- Card Gráfica --}}

        @include('home.card_graph')


        {{-- Boxes --}}

        @include('home.boxes_reports')

        {{-- tablas reportes productos--}}
        @include('home.tables_reports')

        {{-- Mejores vendedores y compradores --}}
        @include('home.best_sellers_buyers')

        @endif
    </x-card>

</div>
