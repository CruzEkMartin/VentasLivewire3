<div>

    <x-card cardTitle="Listado de categorias ({{ $this->totalRegistros }})">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCategoria">Crear categoría</a>
        </x-slot:cardTools>

        <x-table>

            <x-slot:thead>
                <th>Id</th>
                <th>Nombre</th>
                <th width="10%">Acciones</th>
            </x-slot:thead>

            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="#" title="Ver" class="btn btn-success btn-xs mr-2"><i class="far fa-eye"></i></a>
                        <a href="#" title="Editar" class="btn btn-primary btn-xs mr-2"><i
                                class="far fa-edit"></i></a>
                        <a href="#" title="Eliminar" class="btn btn-danger btn-xs"><i
                                class="far fa-trash-alt"></i></a>
                    </td>
                </tr>

            @empty
                <tr class="text-center">
                    <td colspan="3">Sin registros</td>
                </tr>
            @endforelse

        </x-table>

        <x-slot:cardFooter>
            {{ $categories->links() }}
        </x-slot:cardFooter>

    </x-card>

    <x-modal modalId="modalCategoria" modalTitle="Categorias">

        <form wire:submit="store">
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre:</label>
                    <input wire:model='name' type="text" class="form-control" placeholder="Nombre de la categoría"
                        id="name">
                    @error('name')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <button class="btn btn-primary float-right">Guardar</button>
        </form>

    </x-modal>

</div>
