<x-modal modalId="modalProducto" modalTitle="Productos" modalSize="modal-lg">

    <form wire:submit={{ $Id == 0 ? 'store' : "update($Id)" }}>

        <div class="form-row">

            {{-- Input name --}}
            <div class="form-group col-md-7">
                <label for="name">Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre del producto"
                    id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Select Categoria --}}
            <div class="form-group col-md-5">
                <label for="category_id">Categoría:</label>
                <select wire:model="category_id" id="category_id" class="form-control">
                    <option value="">Seleccionar</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>

                @error('category_id')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


            {{-- Textarea Descripcion --}}
            <div class="form-group col-md-12">
                <label for="descripcion">Descripcion:</label>
                <textarea wire:model='descripcion' id="descripcion" class="form-control" rows="3"></textarea>

                @error('descripcion')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Precio Compra --}}
            <div class="form-group col-md-4">
                <label for="precio_compra">Precio de Compra:</label>
                <input wire:model='precio_compra' min="0" step="any" type="number" class="form-control"
                    placeholder="Precio de compra del producto" id="precio_compra">
                @error('precio_compra')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Precio Venta --}}
            <div class="form-group col-md-4">
                <label for="precio_venta">Precio de Venta:</label>
                <input wire:model='precio_venta' min="0" step="any" type="number" class="form-control"
                    placeholder="Precio de venta del producto" id="precio_venta">
                @error('precio_venta')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


            {{-- Input Código de Barras --}}
            <div class="form-group col-md-4">
                <label for="codigo_barras">Código de Barras:</label>
                <input wire:model='codigo_barras' type="text" class="form-control"
                    placeholder="Código de barras del producto" id="codigo_barras">
                @error('codigo_barras')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


            {{-- Input Stock --}}
            <div class="form-group col-md-4">
                <label for="stock">Stock:</label>
                <input wire:model='stock' type="number" min="0" class="form-control" placeholder="Stock del producto"
                    id="stock">
                @error('stock')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Stock Mínimo --}}
            <div class="form-group col-md-4">
                <label for="stock_minimo">Stock Mínimo:</label>
                <input wire:model='stock_minimo' min="0" type="number" class="form-control"
                    placeholder="Stock Mínimo del producto" id="stock_minimo">
                @error('stock_minimo')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


            {{-- Input Fecha de Vencimiento --}}
            <div class="form-group col-md-4">
                <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                <input wire:model='fecha_vencimiento' type="date" class="form-control"
                    id="fecha_vencimiento">
                @error('fecha_vencimiento')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Checkbox Active --}}
            <div class="form-group col-md-3">
                <div class="icheck-primary">
                    <input wire:model='active' type="checkbox" id="active" checked>
                    <label for="active">¿Está activo?</label>
                </div>

                @error('active')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


            {{-- Input Imagen --}}
            <div class="form-group col-md-3">
                <label for="image">Imagen</label>
                <input wire:model='image' type="file" id="image" accept="image/*">

                @error('image')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>


            {{--  Imagen --}}
            <div class="form-group col-md-6">
                @if ($this->image)
                <img src="{{ $image->temporaryUrl()}}" class="rounded float-right" width="200">
                @endif
            </div>

        </div>
        <hr>
        <button wire:loading.attr='disabled' class="btn btn-primary float-right">{{ $Id == 0 ? 'Guardar' : 'Actualizar' }}</button>
    </form>

</x-modal>
