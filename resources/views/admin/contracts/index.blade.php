@extends('layouts.admin')

@section('content')
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNew">
  <i class="fa fa-plus"></i> Agregar
</button>
    <h1>Contratos</h1>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>Bombre</th>
                <th># de contrato</th>
                <th>Grupo de productos</th>
                <th>Clientes / Pedidos</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contracts as $contract)
            <tr>
                <td>{{ $contract->id }}</td>
                <td>
                    <a href="/admin/contracts/{{ $contract->id }}/edit">{{ $contract->name }}</a><br />
                </td>
                <td>{{ $contract->number }}</td>
                <td>{{ $contract->group->name }}</td>
                <td>
                  {{ $contract->users->count() }} / {{ $contract->orders->count() }}
                  <a href="/admin/contracts/{{ $contract->id }}" class="btn btn-sm btn-primary">Detalles</a><br />
                </td>
                <td>
                  {{ $contract->created_at->diffForHumans() }}<br>
                  <small>{{ $contract->created_at }}</small>
                </td>
                <td>
                  {{ $contract->updated_at->diffForHumans() }}<br>
                  <small>{{ $contract->updated_at }}</small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>




<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ url('admin/contracts') }}">
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
                <label for="number">Número único de contrato</label>
                <input type="number" name="number" id="number" class="form-control" required>
            </div>
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
