@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            @include('user.part.userblock')
        </div>

        <div class="col-lg-4 col-lg-offset-3">

            @if(Auth::user()->hasFriendRequestPending($user))
                <p>
                    В ожидании {{ $user->getFirstNameOrUsername() }}
                    подтвержения запроса в друзья.
                </p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
                <p>
                    <a href="{{ route('friend.accept', ['username' => $user->username]) }}"
                       class="btn btn-primary mb-2">Подтвердить</a>
                </p>
            @elseif(Auth::user()->isFriendWith($user))
                {{ $user->getFirstNameOrUsername() }} у Вас в друзьях.
            @elseif ( Auth::user()->id !== $user->id )
                <a href="{{ route('friend.add', ['username' => $user->username]) }}"
                   class="btn btn-primary mb-2">Добавить в друзья</a>
            @endif

            <h4>Друзья ({{ $user->friends()->count() ?: 0 }})</h4>

            @if(!$user->friends()->count())
                <p>нет друзей</p>
            @else
                @foreach($user->friends() as $user)
                    @include('user.part.userblock')
                @endforeach
            @endif

        </div>
    </div>
@endsection
