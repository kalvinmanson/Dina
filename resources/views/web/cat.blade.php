@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name }}</h1>
    <div class="card-columns">
    @foreach($category->pages as $page)
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h4>{{ $page->name }}</h4>
            </div>
            <div class="card-body">
                <p>{{ $page->description }}</p>
                <a href="/{{ $page->category->slug }}/{{ $page->slug }}" class="btn btn-secondary">Go to page</a>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
