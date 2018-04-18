@extends('layouts.admin')

@section('content')
    <h1>Countries: Edit {{ $user->name }}</h1>
    <form method="POST" action="{{ url('admin/users/' . $user->id) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Colombia" value="{{ old('name') ? old('name') : $user->name }}">
                </div>
                <div class="form-group">
                    <label for="domain">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="Admin" {{ $user->role == "Admin" ? 'selected' : '' }}>Admin</option>
                        <option value="User" {{ $user->role == "User" ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
            <div class="col-md-4">
                <h3>Available Products</h3>
                @foreach($products as $product)
                <div class="custom-control custom-checkbox">
                  <input name="products[]" type="checkbox" class="custom-control-input" id="product_{{ $product->id }}" value="{{ $product->id }}"
                  {{ $user->products->where('id', $product->id)->first() ? 'checked' : '' }}>
                  <label class="custom-control-label" for="product_{{ $product->id }}">{{ $product->name }}</label>
                </div>
                @endforeach
            </div>
        </div>
    </form>
@endsection
