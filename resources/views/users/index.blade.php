@extends('layout.default')

@section('title', 'User Index')

@section('content')

<div class="user-list-container">
    <h2 class="user-list-title">所有用户</h2>
    <ul class="user-list">
        @foreach ($users as $user)
            @include('users._user', ['user' => $user])
        @endforeach
    </ul>
    <div class="pagination">
        {!! $users->render() !!}
    </div>
</div>

@endsection
