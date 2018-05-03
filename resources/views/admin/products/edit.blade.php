@extends('layouts.admin')

@section('content')
    <h1>Productos: Edit {{ $product->name }}</h1>
        <div class="row">
            <div class="col-md-8">
            <form method="POST" action="{{ url('admin/products/' . $product->id) }}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-5">
                      <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Nombre del producto</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Example Page" value="{{ old('name') ? old('name') : $product->name }}">
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label for="presentation">Presentacion</label>
                        <input type="text" class="form-control" id="presentation" name="presentation" placeholder="ej. Litro, galon, etc" value="{{ old('presentation') ? old('presentation') : $product->presentation }}">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') ? old('price') : $product->price }}">
                    </div>
                  </div>
                </div>

                {{--<div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="text" class="form-control ckfile" id="picture" name="picture" readonly placeholder="/picture/of/this/page" value="{{ old('picture') ? old('picture') : $product->picture }}">
                </div>--}}
                <div class="form-group">
                    <label for="description">Descripción del producto</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Describe your page">{{ old('description') ? old('description') : $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
                </form>
            </div>
        </div>
    {!! Form::open([
    'method' => 'DELETE',
    'route' => ['admin.products.destroy', $product->id]
    ]) !!}
        {!! Form::submit('Delete this this?', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
    {!! Form::close() !!}

@endsection
