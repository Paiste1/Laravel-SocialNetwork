@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <h3>Ваши друзья ({{ $friends->count() }})</h3>

            @if(!$friends->count())
                <p>нет друзей</p>
            @else
                @foreach($friends as $user)
                    @include('user.part.userblock')
                @endforeach
            @endif

        </div>

        <div class="col-lg-6">
            <h3>Запросы в друзья ({{ $requests->count() }})</h3>

            @if(!$requests->count())
                <p>нет запросов в друзья</p>
            @else
                @foreach($requests as $user)
                    @include('user.part.userblock')
                @endforeach
            @endif

        </div>
    </div>
@endsection
