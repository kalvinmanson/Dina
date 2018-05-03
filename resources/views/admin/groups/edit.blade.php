@extends('layouts.admin')

@section('content')
    <h1>Pages: Edit {{ $group->name }}</h1>
        <form method="POST" action="{{ url('admin/groups/' . $group->id) }}"><div class="row">
            <div class="col-md-7">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Example Page" value="{{ old('name') ? old('name') : $group->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Describe your page">{{ old('description') ? old('description') : $group->description }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
            <div class="col-sm-5">
              <h3>Available Products</h3>
              @foreach($products as $product)
              <div class="custom-control custom-checkbox border-bottom pt-2">
                <input name="products[]" type="checkbox" class="custom-control-input" id="product_{{ $product->id }}" value="{{ $product->id }}"
                {{ $group->products->where('id', $product->id)->first() ? 'checked' : '' }}>
                <label class="custom-control-label" for="product_{{ $product->id }}">
                  {{ $product->id }} | {{ $product->name }}<br>
                  <small>{{ $product->presentation }}</small>
                </label>
              </div>
              @endforeach
            </div>
        </div>
      </form>


    {!! Form::open([
    'method' => 'DELETE',
    'route' => ['admin.groups.destroy', $group->id]
    ]) !!}
        {!! Form::submit('Delete this this?', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
    {!! Form::close() !!}


@endsection
