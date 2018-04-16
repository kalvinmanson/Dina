<div class="sidefields">
	<div class="card bg-secondary text-white">
	  <div class="card-header">New field</div>
	  <div class="card-body">
	  	<form method="POST" action="{{ url('admin/fields') }}">
	  		{{ csrf_field() }}
		    <div class="form-group">
		    	<label form="name">Name</label>
		    	<select name="name" id="name" class="form-control tr_name_field">
		    		@foreach($fields as $field)
		    			<option value="{{ $field->name }}">{{ $field->name }}</option>
		    		@endforeach
		    	</select>
		    </div>
		    <div class="form-group">
		    	<label form="format">Format</label>
		    	<select name="format" id="format" class="form-control tr_format_field">
		    		@foreach($formats as $format)
		    			<option value="{{ $format->format }}">{{ $format->format }}</option>
		    		@endforeach
		    	</select>
		    </div>
		    <div class="form-group">
		    	<label form="content">Content</label>
		    	<textarea name="content" id="content" class="form-control"></textarea>
		    </div>
		    <div class="form-group">
				<input type="hidden" name="page_id" value="{{ $destiny == "page" ? $page->id : 0 }}">
				<input type="hidden" name="category_id" value="{{ $destiny == "category" ? $category->id : 0 }}">
		    	<button type="submit" class="btn btn-primary">Save</button>
		    </div>
		</form>
	  </div>
	</div>

	<div class="list-group">
	@foreach ($pastFields as $field)
	  <div class="list-group-item">

	  	{!! Form::open([
	  	    'method' => 'DELETE',
	  	    'route' => ['admin.fields.destroy', $field->id]
	  	]) !!}
	  		<div class="btn-group pull-right">
		  	    <a href="/admin/fields/{{ $field->id }}/edit" class="btn btn-warning btn-sm" data-fancybox data-type="ajax"><i class="fa fa-edit"></i></a>
		  	    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
	  	    </div>
	  	{!! Form::close() !!}

	    <h4 class="list-group-item-heading">{{ $field->name }}<small>({{ $field->format }})</small></h4>
	    <p class="list-group-item-text">{{ $field->content }}</p>
	  </div>
	@endforeach
	</div>
</div>
