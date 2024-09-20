<div>
    <form >
        <div class="input-group">
            <input wire:model.live='search' type="search" class="form-control" placeholder="Buscar Producto...">
            <div class="input-group-append">
                <button wire:click.prevent class="btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <ul class="list-group" id="list-search">
        @foreach ( $productos as $producto )
        <li class="list-group-item">
            <h5>
                <a href="{{ route('productos.show', $producto) }}" class="text-white">
                <x-image :item="$producto" size="50"/>
                {{ $producto->name }}
            </a>
            </h5>
            <div class="d-flex justify-content-between">
                <div class="mr-2">
                    Precio venta:
                    <span class="bagde badge-pill badge-info">{!! $producto->precio !!}</span>
                </div>
                <div>
                    Stock: {!! $producto->stockLabel !!}

                </div>
            </div>

        </li>
        @endforeach
    </ul>

</div>
