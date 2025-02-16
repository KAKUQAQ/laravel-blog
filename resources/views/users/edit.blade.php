@extends('layout.default')

@section('title', "Update")

@section('content')
<div class="auth-container">
    <h5 class="text-center">更新个人资料</h5>
    @include('shared._errors')
    <div class="gravatar_edit text-center">
        <a href="https://gravatar.com/emails" target="_blank">
            <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar"/>
        </a>
    </div>
    <form method="POST" action="{{ route('users.update', $user->id )}}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">名称：</label>
            <input type="text" id="name" name="name" class="form-control custom-input" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">邮箱：</label>
            <input type="text" id="email" name="email" class="form-control custom-input" value="{{ $user->email }}" disabled>
        </div>

        <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" id="password" name="password" class="form-control custom-input" value="{{ old('password') }}">
        </div>

        <div class="form-group">
            <label for="password_confirmation">确认密码：</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control custom-input" value="{{ old('password_confirmation') }}">
        </div>

        <button type="submit" class="custom-button">更新</button>
    </form>
</div>
@endsection
