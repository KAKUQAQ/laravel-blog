@extends('layout.default')
@section('title', $title)

@section('content')
    <div class="show-follow-container">
        <h2 class="show-follow-title">{{ $title }}</h2>

        @if (count($users) > 0)
            <ul class="follow-list">
                @foreach ($users as $user)
                    <li class="follow-list-item">
                        <div class="user-info">
                            <a href="{{ route('users.show', $user) }}">
                                <img src="{{ $user->gravatar('50') }}" alt="{{ $user->name }}">
                            </a>
                            <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                        </div>
                        @include('users._follow_form')
                    </li>
                @endforeach
            </ul>

            <div class="pagination">
                {!! $users->render() !!}
            </div>
        @else
            <p class="text-center">没有用户信息。</p>
        @endif
    </div>
@endsection
