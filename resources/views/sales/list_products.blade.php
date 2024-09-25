<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-tshirt mr-1"></i> Productos</h3>
    </div>

    <div class="card-body">

        <x-table>

            <x-slot:thead>
                <th scope="col">#</th>
                <th scope="col"><i class="fas fa-image"></i></th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio.vt</th>
                <th scope="col">Stock</th>
                <th scope="col">...</th>

            </x-slot>

            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>
                        <x-image :item="$producto" size="60" />
                    </td>
                    <td>{{ $producto->name }}</td>
                    <td>{!! $producto->precio !!}</td>
                    <td>{!! $producto->stockLabel !!}</td>
                    <td>
                        <button wire:click = "addProducto({{ $producto->id }})" class="btn btn-primary btn-sm"
                            title="Agregar">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6">Sin Registros</td>
                </tr>
            @endforelse



        </x-table>

    </div>
    <div class="card-footer">
        {{ $productos->links() }}
    </div>

</div>
