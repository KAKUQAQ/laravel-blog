@if($feed_items->count() > 0)
    <ul class="list-unstyled">
        @foreach($feed_items as $status)
            @include('statuses._status', ['user'=>$status->user])
        @endforeach
    </ul>
    <div class="pagination">
        {!! $feed_items->render() !!}
    </div>
@else
    <p>还没有新鲜事</p>
@endif
