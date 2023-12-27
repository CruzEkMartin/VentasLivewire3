<div>

    <x-card cardTitle="Listado Categorías ({{ $this->totalRegistros }})" cardFooter="Card Footer">

        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCategory">Crear categoría</a>
        </x-slot:cardTools>


        <x-table>

            <x-slot:thead>
                <th>Id</th>
                <th>Nombre</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot:thead>


            <tr>
                <td>...</td>
                <td>...</td>
                <td>
                    <a href="#" class="btn btn-success btn-xs" title="Ver">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                <td>
                    <a href="#" class="btn btn-primary btn-xs" title="Editar">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <a href="#" class="btn btn-danger btn-xs" title="Eliminar">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>

        </x-table>

    </x-card>

    <x-modal modalId="modalCategory" modalTitle="Categorias">
        <form wire:submit="store">

            <div class="row">
                <div class="col">

                    <input type="text" wire:model.live='name' class="form-control"
                        placeholder="Nombre de la categoría">
                    @Error('name')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary float-right">Save changes</button>
        </form>
    </x-modal>

</div>
