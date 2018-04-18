@extends('layouts.admin')

@section('content')

    <h1>Orders</h1>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>User</th>
                <th>Products</th>
                <th>Total</th>
                <th>Comments</th>
                <th></th>
                <th>Created at</th>
                <th>Updated at</th>
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
                </td>
                <td>
                  @foreach(json_decode($order->products) as $product)
                  {{ $product->name }} <small>( $ {{ $product->price }} COP)</small> x{{ $product->quantity }} <strong>( $ {{ $product->total }} COP)</strong><br>
                  @endforeach
                </td>
                <td>$ {{ $order->total }} COP</td>
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
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
