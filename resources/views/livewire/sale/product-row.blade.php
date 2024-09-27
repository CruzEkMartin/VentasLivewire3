<tr>
    <td>{{ $producto->id }}</td>
    <td>
        <x-image :item="$producto" size="60" />
    </td>
    <td>{{ $producto->name }}</td>
    <td>{!! $producto->precio !!}</td>
    <td>{!! $producto->stockLabel !!}</td>
    <td>
        <button wire:click = "addProducto({{ $producto->id }})" class="btn btn-primary btn-sm" title="Agregar">
            <i class="fas fa-plus-circle"></i>
        </button>
    </td>

</tr>
