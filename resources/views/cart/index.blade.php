@extends('layouts.app')
@section('title', 'MultiServicios Dina')
@section('meta-keywords', 'Keywords for seo')
@section('meta-description', 'Description for SEO')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3>Productos agregados</h3>
        <table class="table table-striped">
          <tr>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th width="120">Cantidad</th>
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
            <td>
              {{ $cart->product->id }} | {{ $cart->product->name }}<br>
              <small>{{ $cart->product->presentation }}</small>
            </td>
            <td>$ {{ number_format($cart->product->price) }}</td>
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
            <td>$ {{ number_format($total_product) }}</td>
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
            <td>$ {{ number_format($total) }}</td>
            <td></td>
          </tr>
        </table>

        <h3>Productos disponibles</h3>
        <table class="table table-striped">
          <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th></th>
          </tr>
          @foreach($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>
                {{ $product->name }}<br>
                <small>{{ $product->presentation }}</small>
              </td>
              <td>$ {{ number_format($product->price) }}</td>
              <td>
                <form action="/cart" method="POST">
                  {{ csrf_field() }}
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <button class="btn btn-outline-secondary btn-sm" type="submit">Agregar <i class="fa fa-shopping-cart"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="col-sm-4">
        <div class="card bg-dark text-white">
          <div class="card-header">Realizar pedido</div>
          <div class="card-body">
            <p>Total: <strong> $ {{ number_format($total) }}</strong><br>
            Saldo: <strong> $ {{ number_format(Auth::user()->budget) }}</strong></p>
            @if($total > 0 && $total <= Auth::user()->budget)
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
              <p class="text-danger text-center">Tu presupuesto no es suficiente para realizar este pedido o no has agregado ningún producto a tu carro de compras.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
