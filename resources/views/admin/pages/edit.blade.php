@extends('layouts.admin')

@section('content')
    <h1>Pages: Edit {{ $page->name }}</h1>
        <div class="row">
            <div class="col-md-8">
            <form method="POST" action="{{ url('admin/pages/' . $page->id) }}">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                @if($page->trashed())
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="untrash" value="1"> This record was deleted. You want undelete?
                        </label>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $page->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control" value="{{ $page->weight }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Example Page" value="{{ old('name') ? old('name') : $page->name }}">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="example-page" value="{{ old('slug') ? old('slug') : $page->slug }}">
                </div>
                <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="text" class="form-control ckfile" id="picture" name="picture" readonly placeholder="/picture/of/this/page" value="{{ old('picture') ? old('picture') : $page->picture }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Describe your page">{{ old('description') ? old('description') : $page->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control">{{ old('content') ? old('content') : $page->content }}</textarea>
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
                @include('admin.fields.share', ['pastFields' => $page->fields, 'destiny' => 'page'])
            </div>
        </div>


    {!! Form::open([
    'method' => 'DELETE',
    'route' => ['admin.pages.destroy', $page->id]
    ]) !!}
        {!! Form::submit('Delete this this?', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
    {!! Form::close() !!}

    {!! Form::open([
        'method' => 'POST',
        'route' => ['admin.pages.duplicate']
    ]) !!}
        <input type="hidden" name="id" value="{{ $page->id }}">
        {!! Form::submit('Duplicate', ['class' => 'btn btn-primary pull-right btn-sm']) !!}
    {!! Form::close() !!}

@endsection
