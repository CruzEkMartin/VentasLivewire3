<div class="card card-info">
    <div class="card-header terciario">
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
                <livewire:sale.product-row :producto="$producto" :wire:key="$producto->id">
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
