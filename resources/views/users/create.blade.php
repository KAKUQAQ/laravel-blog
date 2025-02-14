@extends('layout.default')

@section('title', 'Signup')

@section('content')
    <div class="register-container text-center">
        <h2>用户注册</h2>
        @include('shared._errors')
        <form method="POST" action="{{ route('users.store') }}">

            {{ csrf_field() }}

            <div class="mb-3 text-start">
                <label for="name" class="form-label">名称</label>
                <input type="text" id="name" name="name" placeholder="请输入您的名称" value="{{ old('name') }}">
            </div>
            <div class="mb-3 text-start">
                <label for="email" class="form-label">邮箱</label>
                <input type="email" id="email" name="email" placeholder="请输入您的邮箱" value="{{ old('email') }}">
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label">密码</label>
                <input type="password" id="password" name="password" placeholder="请输入密码" >
            </div>
            <div class="mb-3 text-start">
                <label for="password_confirmation" class="form-label">确认密码</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="请再次输入密码" required>
            </div>
            <button type="submit" class="signup-button">注册</button>
        </form>
    </div>



@endsection



