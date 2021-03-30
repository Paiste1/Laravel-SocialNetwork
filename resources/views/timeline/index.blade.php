@extends('templates.default')

@section('content')

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

    <div class="row">
        <div class="col-lg-5">

        </div>
    </div>

@endsection
