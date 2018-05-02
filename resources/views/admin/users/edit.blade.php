@extends('layouts.admin')

@section('content')
    <h1>Countries: Edit {{ $user->name }}</h1>
    <form method="POST" action="{{ url('admin/users/' . $user->id) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Colombia" value="{{ old('name') ? old('name') : $user->name }}">
                </div>
                <div class="form-group">
                    <label for="domain">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="Admin" {{ $user->role == "Admin" ? 'selected' : '' }}>Admin</option>
                        <option value="User" {{ $user->role == "User" ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                  <label for="domain">Contrato</label>
                  <select name="contract_id" id="contract_id" class="form-control">
                    @foreach($contracts as $contract)
                      <option value="{{ $contract->id }}">{{ $contract->name }} | (#{{ $contract->number }})</option>
                    @endforeach
                  </select>
              </div>
            </div>
        </div>
    </form>
    <h3>Pedidos</h3>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>Cliente</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Comentarios</th>
                <th></th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->orders as $order )
            <tr class="
              {{ $order->status == 'Pendiente' ? 'table-warning' : '' }}
              {{ $order->status == 'Aceptado' ? 'table-success' : '' }}
              {{ $order->status == 'Cancelado' ? 'table-danger' : '' }}
              ">
                <td>{{ $order->id }}</td>
                <td>
                  {{ $order->user->name }}<br>
                  <small>{{ $order->user->email }}</small>
                </td>
                <td>
                  <a href="#listOrder_{{ $order->id}}" class="btn btn-secondary" data-fancybox><i class="fa fa-list"></i> ver</a>
                  <div id="listOrder_{{ $order->id}}" style="display: none;">
                    <table class="table table-striped">
                      <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                      </tr>
                      @foreach(json_decode($order->products) as $product)
                      <tr>
                        <td>{{ $product->code }}</td>
                        <td>
                          {{ $product->name }}<br>
                          <small>{{ $product->presentation }}</small>
                        </td>
                        <td>$ {{ number_format($product->price) }} </td>
                        <td>x{{ $product->quantity }}</td>
                        <td>$ {{ number_format($product->total) }}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </td>
                <td>$ {{ number_format($order->total) }}</td>
                <td>{{ $order->comments }}</td>
                <td>
                  @if($order->status == 'Pendiente')
                  <form action="/admin/orders/{{ $order->id }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put" />
                    <div class="input-group input-group-sm mb-3">
                      <select name="status" class="form-control form-control-sm">
                        <option value="Aceptado" {{ $order->status == 'Aceptado' ? 'selected' : '' }}>Aceptado</option>
                        <option value="Cancelado" {{ $order->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                      </select>
                      <button class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
                    </div>
                  </form>
                  @endif
                </td>
                <td>
                  {{ $order->created_at->diffForHumans() }}<br>
                  <small>{{ $order->created_at }}</small>
                </td>
                <td>
                  {{ $order->updated_at->diffForHumans() }}<br>
                  <small>{{ $order->updated_at }}</small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
