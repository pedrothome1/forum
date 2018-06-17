@extends('layouts.app')

@section('content')
    <div class="card border-0">
        <div class="card-header custom-card-header text-white bg-primary">
            <i class="fa fa-cog fa-lg"></i>

            <span>Atualizar conta</span>
        </div>

        <div class="card-body">
            <form method="POST" action="/settings">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name" class="text-xs text-secondary text-uppercase font-weight-600">Nome completo</label>

                    <input type="text"
                           class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           id="name"
                           name="name"
                           value="{{ $user->name }}">

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="username" class="text-xs text-secondary text-uppercase font-weight-600">Nome de usuário</label>

                    <input type="text"
                           class="form-control rounded-0{{ $errors->has('username') ? ' is-invalid' : '' }}"
                           id="username"
                           name="username"
                           value="{{ $user->username }}">

                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email" class="text-xs text-secondary text-uppercase font-weight-600">E-mail</label>

                    <input type="text"
                           class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           id="email"
                           name="email"
                           value="{{ $user->email }}">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="text-xs text-secondary text-uppercase font-weight-600">Senha</label>

                    <input type="text"
                           class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           id="password"
                           name="password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="text-xs text-secondary text-uppercase font-weight-600">Confirme a senha</label>

                    <input type="text"
                           class="form-control rounded-0"
                           id="password_confirmation"
                           name="password_confirmation">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary">
                        Atualizar conta
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
