@extends('layout.default')
@section('title', '登录')

@section('content')
    <div class="auth-container">
        <div class="card">
            <div class="card-header text-center">
                <h5>登录</h5>
            </div>
            <div class="card-body">
                @include('shared._errors')

                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" id="email" name="email" class="form-control custom-input" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" id="password" name="password" class="form-control custom-input" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">记住我</label>
                        </div>
                    </div>

                    <button type="submit" class="custom-button">登录</button>
                </form>

                <hr>

                <p class="text-center description">还没账号？<a href="{{ route('signup') }}">现在注册！</a><a href="{{ route('password.request') }}">忘记密码</a> </p>
            </div>
        </div>
    </div>
@endsection
