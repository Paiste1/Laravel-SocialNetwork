@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h3>Регистрация</h3>
            <form method="post" action="{{ route('auth.signup') }}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" id="email" placeholder="Введите email"
                           value="{{ Request::old('email') }}">
                    @if($errors->has('email'))
                        <span class="help-block text-danger">{{ $errors->first('email') ?: ''}}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="username">Логин</label>
                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                           name="username" id="username" placeholder="Введите логин"
                           value="{{ Request::old('username') }}">
                    @if($errors->has('username'))
                        <span class="help-block text-danger">{{ $errors->first('username') ?: ''}}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           name="password" id="password" placeholder="Введите пароль">
                    @if($errors->has('password'))
                        <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Создать аккаунт</button>
            </form>
        </div>
    </div>
@endsection
