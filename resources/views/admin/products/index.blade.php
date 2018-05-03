@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-sm-4">
    <h1>Productos</h1>
  </div>
  <div class="col-sm-4">
    <form class="form-inline">
      <label class="sr-only" for="q">Buscar:</label>
      <input type="text" class="form-control mb-2 mr-sm-2" id="q" name="q" placeholder="Nombre del producto">
      <button type="submit" class="btn btn-secondary mb-2"><i class="fa fa-search"></i></button>
    </form>
  </div>
  <div class="col-sm-4">
    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNew">
      <i class="fa fa-plus"></i> Agregar
    </button>
  </div>
</div>

    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    <a href="/admin/products/{{ $product->id }}/edit">{{ $product->name }}</a><br />
                    <small>({{ $product->presentation }}) | {{ $product->description }}</small>
                </td>
                <td>{{ $product->category->name }}</td>
                <td>$ {{ number_format($product->price) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                  {{ $product->created_at->diffForHumans() }}<br>
                  <small>{{ $product->created_at }}</small>
                </td>
                <td>
                  {{ $product->updated_at->diffForHumans() }}<br>
                  <small>{{ $product->updated_at }}</small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="text-muted">Mostrando {{ $products->count() }} de un total de {{ $totalprods->count() }}</p>
    {{ $products->links("pagination::bootstrap-4") }}




<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ url('admin/products') }}">
    {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endsection
