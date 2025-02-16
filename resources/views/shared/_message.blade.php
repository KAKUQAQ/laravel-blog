@foreach(['danger', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
        <div class="message-container">
            <div class="message-box alert alert-{{$msg}}">
                {{ session()->get($msg) }}
            </div>
        </div>
    @endif
@endforeach
