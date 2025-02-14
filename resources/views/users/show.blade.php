@extends('layout.default')
@section('title', '$user->name')

@section('content')
    <div>
        <div>
            <div class="user-info-container">
                <section class="user_info">
                    @include('shared._user_info', ['user' => $user])
                </section>
            </div>
        </div>
    </div>
@endsection
