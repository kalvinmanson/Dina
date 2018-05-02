@extends('layouts.admin')

@section('content')
    <h1>Contratos: Editar {{ $contract->name }}</h1>

<form method="POST" action="{{ url('admin/contracts/' . $contract->id) }}">
  <input type="hidden" name="_method" value="PUT">
  {{ csrf_field() }}
  <div class="row">
      <div class="col-sm-5">
          <div class="form-group">
              <label for="group_id">Grupo de productos</label>
              <select name="group_id" id="group_id" class="form-control">
                  @foreach($groups as $group)
                  <option value="{{ $group->id }}" {{ $group->id == $contract->group_id ? 'selected' : '' }}>{{ $group->name }}</option>
                  @endforeach
              </select>
          </div>
      </div>
      <div class="col-sm-2">
          <div class="form-group">
              <label for="number">Número</label>
              <input type="number" name="number" id="number" class="form-control" value="{{ $contract->number }}" required>
          </div>
      </div>
      {{--<div class="col-sm-3">
          <div class="form-group">
              <label for="ammount">Monto</label>
              <input type="number" name="ammount" id="ammount" class="form-control" value="{{ $contract->ammount }}" required>
          </div>
      </div>--}}
  </div>
  <div class="form-group">
      <label for="name">Nombre del contrato</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="ej. Contrato de ejemplo" value="{{ old('name') ? old('name') : $contract->name }}">
  </div>
  <div class="form-group">
      <label for="description">Descripción</label>
      <textarea class="form-control" id="description" name="description" placeholder="Descripción del contrato">{{ old('description') ? old('description') : $contract->description }}</textarea>
  </div>
  <div class="form-group">
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
  </div>
</form>


    {!! Form::open([
    'method' => 'DELETE',
    'route' => ['admin.contracts.destroy', $contract->id]
    ]) !!}
        {!! Form::submit('Delete this this?', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
    {!! Form::close() !!}


@endsection
