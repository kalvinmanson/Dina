@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="jumbotron">
        <h1>{{ $page->name }}</h1>
        {{ $page->content }}
    </div>
</div>
@endsection
