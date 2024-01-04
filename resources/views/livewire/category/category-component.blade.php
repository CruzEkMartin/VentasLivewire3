<div>

    <x-card cardTitle="Listado Categorías ({{ $this->totalRegistros }})" >

        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click='create'> <i class="fas fa-plus-circle"></i> Crear categoría</a>
        </x-slot:cardTools>


        <x-table>

            <x-slot:thead>
                <th>Id</th>
                <th>Nombre</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot:thead>


            @forelse ($categories as $category )
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('categories.show', $category)}}" class="btn btn-success btn-xs" title="Ver">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                <td>
                    <a href="#" wire:click='edit({{ $category->id }})' class="btn btn-primary btn-xs" title="Editar">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <a wire:click="$dispatch('delete',{id:{{ $category->id  }}, eventName:'destroyCategory'})" class="btn btn-danger btn-xs" title="Eliminar">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>

            @empty
                <tr class="text-center">
                    <td colspan="5">Sin registros</td>
                </tr>
            @endforelse

        </x-table>

        <x-slot:cardFooter>
            {{ $categories->links() }}
        </x-slot:cardFooter>
    </x-card>

    <x-modal modalId="modalCategory" modalTitle="Categorias">
        <form wire:submit={{ $categoryId == 0 ? "store" : "update($categoryId)" }}>

            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre:</label>
                    <input type="text" wire:model.live='name' class="form-control"
                        placeholder="Nombre de la categoría" id="name">
                    @Error('name')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary float-right">{{ $categoryId == 0 ? 'Guardar' : 'Actualizar' }}</button>
        </form>
    </x-modal>

</div>
