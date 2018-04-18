@extends('layouts.app')
@section('title', 'MultiServicios Dina')
@section('meta-keywords', 'Keywords for seo')
@section('meta-description', 'Description for SEO')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-8">
        <table class="table table-striped">
          <tr>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Precio Total</th>
            <th></th>
          </tr>
          <?php $total = 0; ?>
          @foreach($carts as $cart)
          <?php
            $total_product = $cart->product->price * $cart->quantity;
            $total += $total_product;
          ?>
          <tr>
            <td>{{ $cart->product->name }}</td>
            <td>$ {{ $cart->product->price }} COP</td>
            <td>
              <form action="/cart/{{ $cart->id }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put" />
                <div class="input-group input-group-sm mb-3">
                  <input type="number" class="form-control form-control-sm" value="{{ $cart->quantity }}" name="quantity" required min=1 style="width: 50px;">
                  <button type="submit" class="btn btn-sm"><i class="fa fa-edit"></i></button>
                </div>
              </form>
            </td>
            <td>$ {{ $total_product }} COP</td>
            <td>
              <form action="/cart/{{ $cart->id }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="delete" />
                <button type="submit" class="btn btn-sm"><i class="fa fa-remove"></i></a>
              </form>
            </td>
          </tr>
          @endforeach
          <tr class="bg-dark text-white">
            <td></td>
            <td></td>
            <td>Total</td>
            <td>$ {{ $total }} COP</td>
            <td></td>
          </tr>
        </table>
      </div>
      <div class="col-sm-4">
        <div class="card bg-dark text-white">
          <div class="card-header">Realizar pedido</div>
          <div class="card-body">
            <p>Total: <strong> $ {{ $total }} COP</strong><br>
            Saldo: <strong> $ {{ Auth::user()->budget }} COP</strong></p>
            @if($total <= Auth::user()->budget)
              <form action="/orders" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="comments">Comentarios adisionales</label>
                  <textarea name="comments" id="comments" class="form-control"></textarea>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-warning btn-lg">Realizar Pedido <i class="fa fa-paper-plane"></i></button>
                </div>
              </form>
            @else
              <p class="text-danger text-center">Tu saldo no es suficiente para realizar este pedido.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
