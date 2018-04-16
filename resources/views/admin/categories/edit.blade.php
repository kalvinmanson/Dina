@extends('layouts.admin')

@section('content')
    <h1>Categories: Edit {{ $category->name }}</h1>
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ url('admin/categories/' . $category->id) }}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                @if($category->trashed())
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="untrash" value="1"> This record was deleted. You want undelete?
                        </label>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Colombia" value="{{ old('name') ? old('name') : $category->name }}">
                </div>
                <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="text" class="form-control ckfile" id="picture" name="picture" readonly placeholder="/picture/of/this/category" value="{{ old('picture') ? old('picture') : $category->picture }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Describe your category">{{ old('description') ? old('description') : $category->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control">{{ old('content') ? old('content') : $category->content }}</textarea>
                    <script type="text/javascript">
                        var editor = CKEDITOR.replace('content');
                    </script>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            @include('admin.fields.share', ['pastFields' => $category->fields, 'destiny' => 'category'])
        </div>
    </div>

    {!! Form::open([
    'method' => 'DELETE',
    'route' => ['admin.categories.destroy', $category->id]
    ]) !!}
        {!! Form::submit('Delete this this?', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
    {!! Form::close() !!}

@endsection