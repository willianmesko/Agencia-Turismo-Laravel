@extends('site.layouts.app')

@section('content-site')
<div class="content">
    <div class="container">
        <h1 class="title">Login</h1>

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-mail</label>

                <div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" planceholder="E-mail" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Senha</label>

                <div>
                    <input id="password" type="password" class="form-control" name="password" planceholder="Senha" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary">
                        Entrar
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Esqueceu a Senha?
                    </a>
                </div>
            </div>
        </form>
    </div><!--container-->
</div><!--content-->
@endsection
