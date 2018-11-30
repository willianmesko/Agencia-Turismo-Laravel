@extends('site.layouts.app')

@section('content-site')
<div class="content">
    <div class="container">
        <h1 class="title">Recuperar Senha</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail</label>

                <div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Enviar Link Recuperação de Senha
                    </button>
                </div>
            </div>
        </form>
    </div><!--container-->
</div><!--content-->
@endsection
