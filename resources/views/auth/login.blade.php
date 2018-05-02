@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
          <p class="text-center"><img src="/img/diamant-dina.png" class="w-50"></p>
          <p class="text-center"><img src="/img/multis-dina.png" class="w-50"></p>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Iniciar Sesión</div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                              @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                              <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                          </div>


                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme en este equipo
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">
                              Iniciar sesión
                          </button>

                          <a class="btn btn-link" href="{{ route('password.request') }}">
                              ¿Olvidaste tu password?
                          </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
