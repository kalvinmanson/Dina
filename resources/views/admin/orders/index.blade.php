@extends('layouts.admin')

@section('content')

    <h1>Orders</h1>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>User</th>
                <th>Productos</th>
                <th>Total</th>
                <th>Comentarios</th>
                <th></th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order )
            <tr class="
              {{ $order->status == 'Pendiente' ? 'table-warning' : '' }}
              {{ $order->status == 'Aceptado' ? 'table-success' : '' }}
              {{ $order->status == 'Cancelado' ? 'table-danger' : '' }}
              ">
                <td>{{ $order->id }}</td>
                <td>
                  {{ $order->user->name }}<br>
                  <small>{{ $order->user->email }}</small>

                  @if($order->user->id == Auth::user()->id)
                  <form action="/admin/orders/{{ $order->id }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put" />
                    <div class="input-group input-group-sm mb-3">
                      <select name="user_id" class="form-control form-control-sm">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>{{ $user->name.' | '.$user->contract->name }}</option>
                        @endforeach
                      </select>
                      <input type="hidden" name="status" value="Pendiente">
                      <button class="btn btn-default btn-sm"><i class="fa fa-edit"></i></button>
                    </div>
                  </form>
                  @endif
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
                      <td>{{ $product->id }}</td>
                      <td>
                        {{ $product->name }}<br>
                        <small>{{ $product->presentation }}</small>
                      </td>
                      <td>$ {{ number_format($product->price) }}</td>
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
