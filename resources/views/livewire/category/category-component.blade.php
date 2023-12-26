<div>

    <x-card cardTitle="Listado Categorías" cardFooter="Card Footer">

        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Crear categoría</a>
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

    <x-modal />

</div>
