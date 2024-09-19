<div>

    <x-card cardTitle="Listado de productos ({{ $this->totalRegistros }})">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'><i class="fas fa-plus-circle mr-1"></i> Crear producto</a>
        </x-slot:cardTools>

        <x-table>

            <x-slot:thead>
                <th>Id</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio Venta</th>
                <th>Stock</th>
                <th>Categoria</th>
                <th>Estado</th>
                <th width="10%">Acciones</th>
            </x-slot:thead>

            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td><x-image :item="$producto"/></td>
                    <td>{{ $producto->name }}</td>
                    <td>{{ $producto->precio_venta }}</td>
                    <td>{!! $producto->stockLabel !!}</td>
                    <td>{{ $producto->category_id }}</td>
                    <td>{{ $producto->active ? "Activo" : "Inactivo" }}</td>
                    <td>
                        <a href="{{ route('productos.show', $producto) }}" title="Ver" class="btn btn-success btn-xs mr-2"><i class="far fa-eye"></i></a>
                        <a href="#" wire:click='edit({{ $producto->id }})' title="Editar" class="btn btn-primary btn-xs mr-2"><i
                                class="far fa-edit"></i></a>
                        <a wire:click="$dispatch('delete',{id: {{ $producto->id }}, eventName: 'destroyProducto'})" title="Eliminar" class="btn btn-danger btn-xs"><i
                                class="far fa-trash-alt"></i></a>
                    </td>
                </tr>

            @empty
                <tr class="text-center">
                    <td colspan="8">Sin registros</td>
                </tr>
            @endforelse

        </x-table>

        <x-slot:cardFooter>
            {{ $productos->links() }}
        </x-slot:cardFooter>

    </x-card>


    @include('products.modal')

</div>
