@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            @include('user.part.userblock')
        </div>

        <div class="col-lg-4 col-lg-offset-3">
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
