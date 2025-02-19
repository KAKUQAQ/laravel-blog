@extends('layout.default')
@section('title', '忘记密码')
@section('content')
    <div class="password-reset-container">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <label for="email">已注册邮箱：</label>
            <input type="email" name="email" id="email" required>
            <button type="submit">发送重置密码链接</button>
        </form>
    </div>

@endsection
