@extends('layout.default')
@section('title', $user->name)

@section('content')
    <div>
        <div>
            <div class="user-info-container">
                <section class="user_info">
                    @if($user->is_active)
                        @include('shared._user_info', ['user' => $user])
                        @if(Auth::check())
                            @include('users._follow_form', ['user' => $user])
                        @endif
                        <section>
                            @include('shared._stats', ['user'=>$user])
                        </section>
                        <hr>
                        <section>
                            @if($statuses->count() > 0)
                                <ul class="list-unstyled">
                                    @foreach($statuses as $status)
                                        @include('statuses._status')
                                    @endforeach
                                </ul>
                            @endif
                        </section>
                    @else
                        <p class="text-center text-warning">您的账户尚未激活</p>
                    @endif
                </section>
            </div>
        </div>
    </div>
@endsection
