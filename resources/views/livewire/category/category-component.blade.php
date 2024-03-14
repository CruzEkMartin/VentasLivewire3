<div>

    <x-card cardTitle="Listado de categorias (0)" cardFooter="Card Footer">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCategoria">Crear categoría</a>
        </x-slot:cardTools>

        <x-table>

            <x-slot:thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </x-slot:thead>


            <tr>
                <td>...</td>
                <td>...</td>
                <td>
                    <a href="#" title="Ver" class="btn btn-success btn-xs mr-2"><i class="far fa-eye"></i></a>
                    <a href="#" title="Editar" class="btn btn-primary btn-xs mr-2"><i class="far fa-edit"></i></a>
                    <a href="#" title="Eliminar" class="btn btn-danger btn-xs"><i
                            class="far fa-trash-alt"></i></a>
                </td>
            </tr>

        </x-table>

    </x-card>

    <x-modal modalId="modalCategoria" modalTitle="Categorias">

        <form>
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nombre de la categoría">
                </div>
            </div>
            <hr>
            <button type="button" class="btn btn-primary float-right">Save changes</button>
        </form>

    </x-modal>

</div>
