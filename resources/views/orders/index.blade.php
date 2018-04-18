@extends('layouts.app')
@section('title', 'MultiServicios Dina')
@section('meta-keywords', 'Keywords for seo')
@section('meta-description', 'Description for SEO')
@section('content')
<div class="container">
  <table class="table table-striped">
    <tr>
      <th>Estado</th>
      <th>Detalles</th>
      <th>Comentarios</th>
      <th>Total</th>
      <th>Fecha</th>
    </tr>
    <?php $total = 0; ?>
    @foreach($orders as $order)
    <tr class="
    {{ $order->status == 'Pendiente' ? 'table-warning' : '' }}
    {{ $order->status == 'Aceptado' ? 'table-success' : '' }}
    {{ $order->status == 'Cancelado' ? 'table-danger' : '' }}
    ">
      <td>{{ $order->status }}</td>
      <td>
        @foreach(json_decode($order->products) as $product)
        {{ $product->name }} <small>( $ {{ $product->price }} COP)</small> x{{ $product->quantity }} <strong>( $ {{ $product->total }} COP)</strong><br>
        @endforeach

      </td>
      <td>{{ $order->comments }}</td>
      <td>$ {{ $order->total }} COP</td>
      <td>{{ $order->created_at }}</td>
    </tr>
    @endforeach
  </table>
</div>
@endsection
