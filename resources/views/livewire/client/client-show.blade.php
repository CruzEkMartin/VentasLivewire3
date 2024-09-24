<x-card cardTitle="Detalles Cliente">
    <x-slot:cardTools>
        <a href="{{ route('clientes') }}" class="btn btn-primary"><i class="fas fa-arrow-circle-left mr-1"></i>
            Regresar</a>
    </x-slot:cardTools>

    {{-- @dump($cliente) --}}

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline" style="background-color: #f5f4f3;">
                <div class="card-body box-profile">

                    <h2 class="profile-username text-center">{{ $cliente->name }}</h2>

                    <ul class="mb-3">
                        <li class="list-group-item">
                            <b>Identificación</b> <a class="float-right">{{ $cliente->identificacion }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $cliente->email }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Teléfono</b> <a class="float-right">{{ $cliente->telefono }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Empresa</b> <a class="float-right">{{ $cliente->empresa }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>NIT</b> <a class="float-right">{{ $cliente->nit }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Creado</b> <a class="float-right">{{ $cliente->created_at }}</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <table class="table text-center">
                <thead style="background-color: #b0aba1;">
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
