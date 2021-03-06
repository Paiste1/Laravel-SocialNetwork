@extends('templates.default')

@section('content')

    <div class="row">
        <div class="col-lg-6">

        @if (!$statuses->count())
            Нет записей...
        @else
            @foreach($statuses as $status)
                <div class="media">
                    <a class="mr-3" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
                        <img class="media-object rounded" src="{{ $status->user->getAvatarUrl() }}"
                             alt="{{ $status->user->getNameOrUsername() }}">
                    </a>
                    <div class="media-body">
                        <h4>
                            <a href="{{ route('profile.index', ['username' => $status->user->username]) }}">
                                {{ $status->user->getNameOrUsername() }}</a>
                        </h4>
                        <p>{{ $status->body }}</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">{{ $status->created_at->diffForHumans() }}</li>
                            <li class="list-inline-item">
                                <a href="#">Лайк</a>
                            </li>
                            <li class="list-inline-item">10 Лайков</li>
                        </ul>

                        {{-- комментарии --}}
                        @foreach($status->replies as $reply)
                            <div class="media">
                                <a class="mr-3" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
                                    <img class="media-object rounded" src="{{ $reply->user->getAvatarUrl() }}"
                                         alt="{{ $reply->user->getNameOrUsername() }}">
                                </a>
                                <div class="media-body">
                                    <h4>
                                        <a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
                                            {{ $reply->user->getNameOrUsername() }}</a>
                                    </h4>
                                    <p>{{ $reply->body }}</p>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">{{ $reply->created_at->diffForHumans() }}</li>
                                        <li class="list-inline-item">
                                            <a href="#">Лайк</a>
                                        </li>
                                        <li class="list-inline-item">10 Лайков</li>
                                    </ul>

                                </div>
                            </div>
                        @endforeach

                        <form method="POST" action="{{ route('status.reply', ['statusId' => $status->id]) }}" class="mb-4">
                            @csrf
                            <div class="form-group">
                                <textarea name="reply-{{ $status->id }}"
                                          class="form-control{{ $errors->has("reply-{$status->id}") ? ' is-invalid' : '' }}"
                                          placeholder="Прокомментировать"
                                          rows="2"></textarea>

                                @if ($errors->has("reply-{$status->id}"))
                                    <div class="invalid-feedback">
                                        {{ $errors->first("reply-{$status->id}") }}
                                    </div>
                                @endif

                            </div>
                            <input type="submit" class="btn btn-primary btn-sm" value="Написать">
                        </form>

                    </div>
                </div>
            @endforeach

            {{ $statuses->links() }}
        @endif

        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('status.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}"
                              placeholder="Чего нового {{ Auth::user()->getFirstNameOrUsername() }} ?" rows="3"></textarea>
                    @if ($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Опубликовать</button>
            </form>
        </div>
    </div>

@endsection
