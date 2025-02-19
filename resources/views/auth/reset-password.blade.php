@extends('layout.default')
@section('title', '重置密码')
@section('content')
    <div class="password-reset-container">
        <h2>重置密码</h2>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <label for="password">新密码</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">确认密码</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>

            <button type="submit">重置密码</button>
        </form>
    </div>

@endsection
