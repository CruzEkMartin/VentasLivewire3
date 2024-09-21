<x-card cardTitle="Detalles usuario">
    <x-slot:cardTools>
        <a href="{{ route('usuarios') }}" class="btn btn-primary"><i class="fas fa-arrow-circle-left mr-1"></i>
            Regresar</a>
    </x-slot:cardTools>

    {{-- @dump($usuario) --}}

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <x-image :item="$usuario" size="250"></x-image>
                    </div>
                    <h2 class="profile-username text-center">{{ $usuario->name }}</h2>
                    <p class="text-muted text-center">{{ $usuario->admin ? 'Administrador' : 'Captura' }}</p>
                    <ul class="mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $usuario->email }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Estatus</b> <a class="float-right">{!! $usuario->activeLabel !!}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Creado</b> <a class="float-right">{{ $usuario->created_at }}</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($category->products as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td><x-image :item="$producto"/></td>
                        <td>{{ $producto->name }}</td>
                        <td>{!!  $producto->precio !!}</td>
                        <td>{!! $producto->stockLabel !!}</td>
                    </tr>
                    @endforeach --}}

                </tbody>
            </table>
        </div>
    </div>
</x-card>
