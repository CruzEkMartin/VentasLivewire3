<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-cart-plus mr-1"></i> Detalles venta </h3>
        <div class="card-tools">
            <!-- Conteo de productos -->
            <i class="fas fa-tshirt " title="Numero productos"></i>
            <span class="badge badge-pill bg-purple ">{{ $cart->count(true) }} </span>
            <!-- Conteo de articulos -->
            <i class="fas fa-shopping-basket ml-2 ml-2" title="Numero items"></i>
            <span class="badge badge-pill bg-purple">{{ $articulos }} </span>
        </div>
    </div>
    <!-- card-body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><i class="fas fa-image"></i></th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio.vt</th>
                        <th scope="col" width="15%">Qty</th>
                        <th scope="col">Sub total</th>
                        <th scope="col">...</th>
                    </tr>

                </thead>
                <tbody>


                    @forelse ($cart as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>
                                <x-image :item="$producto->model" size="60" />

                            </td>
                            <td>{{ $producto->name }}</td>
                            <td>{!! $producto->model->precio !!}</td>
                            <td>
                                <!-- Botones para aumentar o disminuir la cantidad del producto en el carrito -->
                                <button wire:click="decrementar('{{ $producto->rowId }}')"
                                    wire:loading.attr = 'disabled'
                                    wire:target = 'decrementar'
                                    class="btn btn-primary btn-xs">
                                    -
                                </button>

                                <span class="mx-1">{{ $producto->qty }}</span>

                                <button wire:click="incrementar('{{ $producto->rowId }}')"
                                    class="btn btn-primary btn-xs"
                                    wire:loading.attr = 'disabled'
                                    wire:target = 'incrementar'
                                    {{ $producto->qty >= $producto->model->stock ? 'disabled' : ''}}
                                    >
                                    +
                                </button>

                            </td>
                            <td>{{ money($producto->qty * $producto->price) }}</td>
                            <td>
                                <!-- Boton para eliminar el producto del carrito -->
                                <button wire:click="removeItem('{{ $producto->rowId }}')" class="btn btn-danger btn-xs" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="10">Sin Registros</td>
                        </tr>
                    @endforelse


                    <tr>
                        <td colspan="4"></td>
                        <td>
                            <h5>Total:</h5>
                        </td>
                        <td>
                            <h5>
                                <span class="badge badge-pill badge-secondary">
                                    {{ money($total) }}</span>
                            </h5>
                        </td>
                        <td></td>|
                    </tr>
                    <tr>

                        <td colspan="7">
                            <strong>Total en letras:</strong> {{ numerosLetras($total) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <!-- end-card-body -->
</div>
