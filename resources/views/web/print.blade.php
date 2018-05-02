@extends('layouts.print')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-1">
      <img src="/img/diamant-dina.png" class="img-fluid p-2">
    </div>
    <div class="col-sm-9">
      <h1>MultiServicios Dina</h1>
    </div>
  </div>
  <div class="card">
    <div class="card-header">Estado de cuenta</div>
    <div class="card-body">
      <p>
        Nombre: {{ Auth::user()->name }}<br>
        Email: {{ Auth::user()->email }}<br>
        Contrato: {{ Auth::user()->contract->name }}
      </p>
      <table class="table table-striped">
        <tr>
          <th class="bg-secondary text-white" colspan="2">Presupuesto agregado</th>
        </tr>
        @foreach(Auth::user()->budgets as $budget)
        <tr>
          <td>
            $ {{ number_format($budget->budget) }}<br>
            <small>{{ $budget->description }}</small>
          </td>
          <td>
            <i class="fa fa-clock-o"></i> {{ $budget->created_at->diffForHumans() }}<br>
            <small>{{ $budget->created_at }}</small>
          </td>
        </tr>
        @endforeach
        <tr>
          <th class="bg-secondary text-white" colspan="2">Pedidos</th>
        </tr>
        @foreach(Auth::user()->orders as $order)
        <tr>
          <td>
            @foreach(json_decode($order->products) as $product)
            <div class="d-block border-bottom py-1">
              {{ $product->name }} | Precio unidad $ {{ number_format($product->price) }}<br>
              <small>x{{ $product->quantity }} | Total: $ {{ number_format($product->total) }}</small>
            </div>
            @endforeach

            <strong>Total: $ {{ number_format($order->total) }}</strong><br>
            <small>Estado del pedido: {{ $order->status }}</small>
          </td>
          <td>
            <i class="fa fa-clock-o"></i> {{ $order->created_at->diffForHumans() }}<br>
            <small>{{ $order->created_at }}</small>
          </td>
        </tr>
        @endforeach
        <tr>
          <th class="bg-secondary text-white">Presupuesto actual</th>
          <th class="bg-secondary text-white"><strong>$ {{ number_format(Auth::user()->budget) }}</strong></th>
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection
