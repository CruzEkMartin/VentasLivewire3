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
                <thead style="background-color: #b0aba1;">
                    <tr>
                        <th>Id</th>
                        <th>Total</th>
                        <th>Productos</th>
                        <th>Artículos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td><b>FV-{{ $sale->id }}</b></td>
                            <td>{!! money($sale->total) !!}</td>
                            <td>
                                <span class="badge badge-pill badge-primary">
                                    {{ $sale->items->count() }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-primary">
                                    {{ $sale->items->sum('pivot.qty') }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('ventas.show', $sale) }}" class="btn btn-primary btn-sm">Ver Venta</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $sales->links() }}
        </div>
    </div>
</x-card>
