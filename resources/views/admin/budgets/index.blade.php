@extends('layouts.admin')

@section('content')
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNew">
  <i class="fa fa-plus"></i> Agregar
</button>
    <h1>Presupuestos</h1>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>Cliente</th>
                <th>Agregado por</th>
                <th>Presupuesto</th>
                <th>Concepto</th>
                <th>Creado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($budgets as $budget)
            <tr>
                <td>{{ $budget->id }}</td>
                <td>
                  {{ $budget->user->name }}<br>
                  <small>Contrato: {{ $budget->user->contract->name }}</small>
                </td>
                <td>{{ $budget->user_by }}</td>
                <td>$ {{ number_format($budget->budget) }}</td>
                <td>{{ $budget->description }}</td>
                <td>
                  {{ $budget->created_at->diffForHumans() }}<br>
                  <small>{{ $budget->created_at }}</small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>




<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ url('admin/budgets') }}">
    {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar presupuesto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="user_id">Cliente | Contrato</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} | {{ $user->contract->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
              <label for="name">Presupuesto</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                </div>
                <input type="number" name="budget" id="budget" class="form-control" step="1000" value="1000" required>
                <span class="input-group-text">COP</span>
              </div>
            </div>
            <div class="form-group">
              <label for="description">Concepto</label>
              <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> guardar</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endsection
