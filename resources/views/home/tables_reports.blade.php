<div class="row">

    {{-- Productos más vendidos hoy --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Productos más vendidos hoy</b>
                </h3>

                <div class="card-tools">

                </div>
            </div>

            {{-- card-header --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio.vt</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productosMasVendidosHoy as $producto)

                            <tr>
                                <td>{{ $producto->product_id }}</td>
                                <td>
                                 <img src="{{ asset($producto->image) }}" width="50px" class="img-fluid rounded">
                                </td>
                                <td>{{ $producto->name }}</td>
                                <td>{!! money( $producto->price) !!}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $producto->total_quantity}}
                                    </span>
                                </td>
                                <td>{!! money($producto->price * $producto->total_quantity) !!}</td>
                            </tr>

                            @empty



                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            {{-- /.card-body --}}
        </div>
    </div>


    {{-- Productos más vendidos este mes --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Productos más vendidos este mes</b>
                </h3>

                <div class="card-tools">

                </div>
            </div>

            {{-- card-header --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio.vt</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <img src="" width="40" alt="">
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <span class="badge bg-success"></span>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- /.card-body --}}
        </div>
    </div>


    {{-- Productos más vendidos --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Productos más vendidos</b>
                </h3>

                <div class="card-tools">

                </div>
            </div>

            {{-- card-header --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio.vt</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <img src="" width="40" alt="">
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <span class="badge bg-success"></span>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- /.card-body --}}
        </div>
    </div>


    {{-- Productos agregados recientemente --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <b>Productos agregados recientemente</b>
                </h3>

                <div class="card-tools">

                </div>
            </div>

            {{-- card-header --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio venta</th>
                                <th>Stock</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <img src="" width="40" alt="">
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <span class="badge bg-primary"></span>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- /.card-body --}}
        </div>
    </div>
</div>
