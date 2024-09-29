
<x-modal modalId="modalCliente" modalTitle="Clientes">
    <form wire:submit={{$Id==0 ? "store" : "update($Id)"}}>
        <div class="form-row">
            {{-- Input name --}}
            <div class="form-group col-md-6">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input identificacion --}}
            <div class="form-group col-md-6">
                <label for="identificacion">Identificación:</label>
                <input wire:model='identificacion' type="text" class="form-control" placeholder="Identificación" id="identificacion">
                @error('identificacion')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input email --}}
            <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input wire:model='email' type="email" class="form-control" placeholder="Email" id="email">
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input Telefono --}}
            <div class="form-group col-md-6">
                <label for="telefono">Teléfono:</label>
                <input wire:model='telefono' type="number" class="form-control" placeholder="Teléfono" id="telefono">
                @error('telefono')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input Empresa --}}
            <div class="form-group col-md-6">
                <label for="empresa">Empresa:</label>
                <input wire:model='empresa' type="text" class="form-control" placeholder="Empresa" id="empresa">
                @error('empresa')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input NIT --}}
            <div class="form-group col-md-6">
                <label for="nit">NIT:</label>
                <input wire:model='nit' type="text" class="form-control" placeholder="NIT" id="nit">
                @error('nit')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>



        </div>

        <hr>
        <button wire:loading.attr='disabled' class="btn btn-primary float-right">{{$Id==0 ? 'Guardar' : 'Actualizar'}}</button>
    </form>
 </x-modal>
