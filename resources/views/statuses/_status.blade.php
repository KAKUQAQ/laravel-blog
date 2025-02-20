<li>
    <a href="{{ route('users.show', $user->id) }}">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}">
    </a>
    <div>
        <h5>{{ $user->name }} <small> / {{ $status->created_at->diffForHumans() }}</small></h5>
        {{ $status->content }}
    </div>
    @can('destroy', $status)
        <form action="{{ route('statuses.destroy', $status->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this post?')">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit">delete</button>
        </form>

    @endcan
</li>
