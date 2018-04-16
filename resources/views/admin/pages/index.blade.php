@extends('layouts.admin')

@section('content')
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addNew">
  <i class="fa fa-plus"></i> Add New
</button>
    <h1>Pages</h1>
    <table class="table table-striped dataTable">
        <thead class="thead-inverse">
            <tr>
                <th width="10">#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Picture</th>
                <th>Weight</th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr class="{{ $page->trashed() ? "table-danger" : "" }}">
                <td>{{ $page->id }}</td>
                <td>
                    <a href="/admin/pages/{{ $page->id }}/edit">{{ $page->name }}</a><br />
                    <small><a href="/{{ $page->category->slug }}/{{ $page->slug }}" target="_blank">/{{ $page->category->slug }}/{{ $page->slug }}</a></small>
                </td>
                <td>{{ $page->category->name }}</td>
                <td><a href="{{ $page->picture }}" data-fancybox data-caption="{{ $page->name }}">{{ $page->picture }}</a></td>
                <td>{{ $page->weight }}</td>
                <td>{{ $page->created_at }}</td>
                <td>{{ $page->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>




<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="{{ url('admin/pages') }}">
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
