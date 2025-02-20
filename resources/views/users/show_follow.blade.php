@extends('layout.default')
@section('title', $title)

@section('content')
    <div>
        <h2>{{ $title }}</h2>
        <hr>
        <div>
            @foreach($users as $user)
                <div class="list-group-item">
                    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" width=32>
                    <a class="text-decoration-none" href="{{ route('users.show', $user) }}">
                        {{ $user->name }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {!! $users->render() !!}
        </div>
    </div>
@endsection
