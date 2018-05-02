@extends('layouts.app')
@section('title', 'MultiServicios Dina')
@section('meta-keywords', 'Keywords for seo')
@section('meta-description', 'Description for SEO')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-6">
        <p class="text-center"><img src="/img/diamant-dina.png" class="w-50 py-4"></p>
        <p class="text-center">Puedes realizar pedidos hasta un monto no superior al presupuesto actual disponible.</p>
        <p class="text-center">
          <a href="/cart" class="btn btn-lg btn-warning">Realizar Pedido</a>
        </p>
        <p class="text-center">
          <a href="/contact">Devoluciones, dudas, quejas y reclamos</a>
        </p>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header">Estado de cuenta</div>
          <div class="card-body">
            <table class="table table-striped">
              <tr>
                <th class="bg-dark text-white">Presupuesto agregado</th>
              </tr>
              @foreach(Auth::user()->budgets as $budget)
              <tr>
                <td>
                  $ {{ number_format($budget->budget) }} | <i class="fa fa-clock-o"></i> {{ $budget->created_at->diffForHumans() }}<br>
                  <small>{{ $budget->description }}</small>
                </td>
              </tr>
              @endforeach
              <tr>
                <th class="bg-dark text-white">Pedidos</th>
              </tr>
              @foreach(Auth::user()->orders as $order)
              <tr>
                <td>
                  #{{ $order->id }} | $ {{ number_format($order->total) }} | <i class="fa fa-clock-o"></i> {{ $order->created_at->diffForHumans() }}<br>
                  <small>{{ $order->status }}</small>
                </td>
              </tr>
              @endforeach
              <tr>
                <th class="bg-dark text-white">
                  <strong class="float-right">$ {{ number_format(Auth::user()->budget) }}</strong>
                  Presupuesto actual
                </th>
              </tr>
            </table>
          </div>
          <div class="card-footer text-right">
            <a href="/print" target="_blank" class="btn btn-secondary"><i class="fa fa-print"></i> Imprimir</a>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
