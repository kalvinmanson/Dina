@extends('layouts.admin')

@section('content')
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNew">
  <i class="fa fa-plus"></i> Add New
</button>
    <h1>Categories</h1>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>Name</th>
                <th>Picture</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr class="{{ $category->trashed() ? "table-danger" : "" }}">
                <td>{{ $category->id }}</td>
                <td>
                    <a href="/admin/categories/{{ $category->id }}/edit">{{ $category->name }}</a><br />
                    <small><a href="/{{ $category->slug }}" target="_blank">/{{ $category->slug }}</a></small>
                </td>
                <td><a href="{{ $category->picture }}" data-fancybox data-caption="{{ $category->name }}">{{ $category->picture }}</a></td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>




<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ url('admin/categories') }}">
    {{ csrf_field() }}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endsection