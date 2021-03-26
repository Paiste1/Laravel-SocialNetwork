@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Результаты поиска: "{{ Request::input('query') }}"</h3>

            @if(!$users->count())
                <p>Пользователь не найден! Повторите поиск ...</p>
            @else
                <div class="row">
                    <div class="col-lg-6">
                        @foreach($users as $user)
                            @include('user.part.userblock')
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
