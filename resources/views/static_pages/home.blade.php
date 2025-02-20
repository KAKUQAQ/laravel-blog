@extends('layout.default')
@section('title', 'KAKUQAQ')
@section('content')
<div class="container">
    <h1>KAKUQAQ</h1>
    @if(Auth::check())
        <div>
            <section>
                @include('shared._status_form')
            </section>
            <h4>正在发生</h4>
            <hr>
            @include('shared._feed')
        </div>
        <div>
            <section>
                @include('shared._user_info', ['user'=> Auth::user()])
            </section>
            <section>
                @include('shared._stats',['user'=>Auth::user()])
            </section>
        </div>
    @else
        <p>This is a blog for test, but you might want to become a member of it.</p>
        <a href="{{ route('signup') }}" class="btn btn-success signup-link">Signup</a>
    @endif
</div>
@endsection



