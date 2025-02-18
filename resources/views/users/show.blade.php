@extends('layout.default')
@section('title', '$user->name')

@section('content')
    <div>
        <div>
            <div class="user-info-container">
                <section class="user_info">
                    @if($user->is_active)
                        @include('shared._user_info', ['user' => $user])
                    @else
                        <p class="text-center text-warning">您的账户尚未激活</p>
                    @endif
                </section>
            </div>
        </div>
    </div>
@endsection
