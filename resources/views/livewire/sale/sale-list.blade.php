<div>
    <x-card cardTitle="Listado ventas ({{ $this->totalRegistros }})">
        <x-slot:cardTools>
            <span class="badge badge-info" style="font-size: 1.2rem">
                Total : 0
            </span>
            selector fechas
            <a href="{{ route('ventas.create') }}" class="btn btn-primary">
                <i class="fas fa-cart-plus"></i> Crear venta
            </a>
        </x-slot>

        <x-table>
            <x-slot:thead>
                <th>Id</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Productos</th>
                <th>Artículos</th>
                <th>Fecha</th>
                <th width="10%">Acciones</th>
            </x-slot>

            @forelse ($sales as $sale)
                <tr>
                    <td>
                        <span class="badge badge-primary">
                            FV-{{ $sale->id }}
                        </span>
                    </td>
                    <td>{{ $sale->client->name }}</td>
                    <td>
                        <span class="badge badge-secondary">
                            {!! money($sale->total) !!}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-pill bg-purple">
                            {{ $sale->items->count() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-pill bg-purple">
                            {{ $sale->items->sum('pivot.qty') }}
                        </span>
                    </td>
                    <td>{{ $sale->fecha }}</td>
                    <td>
                        <a href="" class="btn bg-indigo btn-xs mr-2" title="Generar PDF"><i
                                class="far fa-file-pdf"></i></a>
                        <a href="{{ route('ventas.show', $sale) }}" class="btn btn-success btn-xs mr-2" title="Ver"><i
                                class="far fa-eye"></i></a>
                        <a href="#" wire:click='edit({{ $sale->id }})' class="btn btn-primary btn-xs mr-2"
                            title="Editar"><i class="far fa-edit"></i></a>
                        <a wire:click="$dispatch('delete',{id: {{ $sale->id }}, eventName:'destroySale'})"
                            class="btn btn-danger btn-xs" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>

            @empty

                <tr class="text-center">
                    <td colspan="7">Sin registros</td>
                </tr>
            @endforelse

        </x-table>

        <x-slot:cardFooter>
            {{ $sales->links() }}

        </x-slot>
    </x-card>


</div>
