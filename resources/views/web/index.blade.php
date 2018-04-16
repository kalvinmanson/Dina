@extends('layouts.app')
@section('title', 'Bienvenido a Drodmin')
@section('meta-keywords', 'Keywords for seo')
@section('meta-description', 'Description for SEO')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <div class="animated bounceInLeft">
                    You are logged in! <i class="fa fa-user"></i> -----
                    <a href="/content/user_1/images/logo-dronico.png" class="btn btn-primary" data-fancybox>Test Btn</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    @include('partials.forms.contact')
</div>
@endsection
