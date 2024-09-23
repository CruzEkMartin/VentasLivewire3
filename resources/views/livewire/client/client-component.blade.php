<div>
    <x-card cardTitle="Listado Clientes ({{$this->totalRegistros}})">
       <x-slot:cardTools>
          <a href="#" class="btn btn-primary" wire:click='create'>
            <i class="fas fa-plus-circle"></i> Crear
          </a>
       </x-slot>

       <x-table>
          <x-slot:thead>
             <th>ID</th>
             <th>Nombre</th>
             <th>Identificación</th>
             <th>Email</th>
             <th>Teléfono</th>
             <th width="3%">...</th>

          </x-slot>

          @forelse ($clientes as $cliente)

             <tr>
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->name}}</td>
                <td>{{$cliente->identificacion}}</td>
                <td>{{$cliente->email}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>
                    <a href="#" title="Ver" class="btn btn-success btn-xs mr-2"><i class="far fa-eye"></i></a>
                    <a href="#" wire:click='edit({{ $cliente->id }})' title="Editar" class="btn btn-primary btn-xs mr-2"><i
                            class="far fa-edit"></i></a>
                    <a wire:click="$dispatch('delete',{id: {{ $cliente->id }}, eventName: 'destroyCliente'})" title="Eliminar" class="btn btn-danger btn-xs"><i
                            class="far fa-trash-alt"></i></a>
                </td>
             </tr>

             @empty

             <tr class="text-center">
                <td colspan="6">Sin registros</td>
             </tr>

             @endforelse

       </x-table>

       <x-slot:cardFooter>
            {{$clientes->links()}}

       </x-slot>
    </x-card>


 <x-modal modalId="modalItem" modalTitle="Items">
    <form wire:submit={{$Id==0 ? "store" : "update($Id)"}}>
        <div class="form-row">
            <div class="form-group col-12">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>
        </div>

        <hr>
        <button class="btn btn-primary float-right">{{$Id==0 ? 'Guardar' : 'Editar'}}</button>
    </form>
 </x-modal>

</div>
