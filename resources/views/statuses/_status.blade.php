<li>
    <div class="status-container">
        <div class="status-header">
            <a href="{{ route('users.show', $status->user->id) }}">
                <img src="{{ $status->user->gravatar('48') }}" alt="{{ $status->user->name }}">
            </a>
            <a class="user-name" href="{{ route('users.show', $status->user->id) }}">{{ $status->user->name }}</a>
            <span class="timestamp">{{ $status->created_at->diffForHumans() }}</span>
        </div>

        <div class="status-content">
            <span>{{ $status->content }}</span>
            @can('destroy', $status)
                <div class="status-actions">
                    <form action="{{ route('statuses.destroy', $status) }}" method="POST" onsubmit="return confirm('确定要删除这条动态吗？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">删除</button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
</li>
