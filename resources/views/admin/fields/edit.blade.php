<div class="container">
    <h1>Edit {{ $field->name }}</h1>

    <form method="POST" action="{{ url('admin/fields/' . $field->id) }}">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="form-group">
            <label form="format">Format</label>
            <select name="format" id="format" class="form-control tr_format_field">
                @foreach($formats as $format)
                    <option value="{{ $format->format }}"  {{ $format->format == $field->format ? 'selected' : '' }}>{{ $format->format }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="10">{{ old('content') ? old('content') : $field->content }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </form>
</div>