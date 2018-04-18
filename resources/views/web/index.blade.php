@extends('layouts.app')
@section('title', 'MultiServicios Dina')
@section('meta-keywords', 'Keywords for seo')
@section('meta-description', 'Description for SEO')
@section('content')
<div class="container">
    <div class="card-columns py-3">
      @foreach($products as $product)
      <div class="card">
        <div class="card-body">
          <h4>{{ $product->name }}</h4>
          <p><small>{{ $product->code }}</small> {{ $product->description }}</p>
          <form action="/cart" method="POST">
            {{ csrf_field() }}
            <div class="input-group input-group-sm mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">$ {{ $product->price }} COP</span>
              </div>
              <div class="input-group-prepend">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn btn-outline-secondary" type="submit">Agregar <i class="fa fa-shopping-cart"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      @endforeach
    </div>
</div>
@endsection
