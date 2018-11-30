@extends('site.layouts.app')

@section('content-site')
<div class="content">
    <div class="container">
        <h1 class="title">Cadastre-se</h1>
        
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Nome</label>

                <div>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome:" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail</label>

                <div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="control-label">Conformar Senha</label>

                <div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary">
                        Cadastrar
                    </button>

                    <a class="btn btn-link" href="{{ route('login') }}">
                        Login?
                    </a>
                </div>
            </div>
        </form>

    </div><!--container-->
</div><!--content-->
@endsection
