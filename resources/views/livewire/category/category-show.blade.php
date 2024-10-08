<x-card cardTitle="Detalles categoría">
    <x-slot:cardTools>
        <a href="{{ route('categorias') }}" class="btn btn-primary"><i class="fas fa-arrow-circle-left mr-1"></i>
            Regresar</a>
    </x-slot:cardTools>

    {{-- @dump($category) --}}

    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline" style="background-color: #f5f4f3;">
                <div class="card-body box-profile">

                    <h2 class="profile-username text-center">{{ $category->name }}</h2>

                    <ul class="mb-3">
                        <li class="list-group-item">
                            <b>Productos</b> <a class="float-right">{{ count($category->products) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Artículos</b> <a class="float-right">
                                {{ $productos->sum('stock') }}
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <table class="table text-center">
                <thead  style="background-color: #b0aba1;">
                    <tr>
                        <th>Id</th>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $productos as $producto )
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td><x-image :item="$producto"/></td>
                        <td>{{ $producto->name }}</td>
                        <td>{!!  $producto->precio !!}</td>
                        <td>{!! $producto->stockLabel !!}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $productos->links() }}
        </div>
    </div>
</x-card>
