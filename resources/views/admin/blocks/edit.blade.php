@extends('layouts.admin')

@section('content')
    <h1>Blocks: Edit {{ $block->name }}</h1>
    <form method="POST" action="{{ url('admin/blocks/' . $block->id) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="ej. Colombia" value="{{ old('name') ? old('name') : $block->name }}">
                </div>
                <div class="form-group">
                    <label for="format">Format</label>
                    <input type="text" class="form-control" id="format" name="format" placeholder="ej. Simple" value="{{ old('format') ? old('name') : $block->format }}">
                </div>
                <div class="form-group">
                    <label for="picture">Picture</label>
                    <input type="text" class="form-control ckfile" id="picture" name="picture" readonly placeholder="/picture/of/this/category" value="{{ old('picture') ? old('picture') : $block->picture }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Describe your category">{{ old('description') ? old('description') : $block->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control">{{ old('content') ? old('content') : $block->content }}</textarea>
                    <script type="text/javascript">
                        var editor = CKEDITOR.replace('content');
                    </script>
                </div>                
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder="ej. /url/destiny" value="{{ old('link') ? old('link') : $block->link }}">
                </div>
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" class="form-control" id="weight" name="weight" placeholder="ej. 1" min="0" step="1" value="{{ old('weight') ? old('weight') : $block->weight }}">
                </div>
                <div class="form-group">
                    <label for="style">Style</label>
                    <textarea class="form-control" id="style" name="style" placeholder="Css styles">{{ old('style') ? old('style') : $block->style }}</textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>

    {!! Form::open([
    'method' => 'DELETE',
    'route' => ['admin.blocks.destroy', $block->id]
    ]) !!}
        {!! Form::submit('Delete this this?', ['class' => 'btn btn-danger btn-sm pull-right']) !!}
    {!! Form::close() !!}

@endsection