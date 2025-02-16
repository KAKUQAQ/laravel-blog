<li class="user-list-item d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="rounded-circle me-2" width="50">
        <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
    </div>

    @if(auth()->check())
        <div class="user-actions d-flex">
            @if(auth()->user()->id === 1 && $user->id !== 1)
                <form action="{{ route('user.toggleAdmin', $user->id) }}" method="POST" class="me-2">
                    @csrf
                    <button type="submit" class="btn btn-sm {{ $user->is_admin ? 'btn-warning' : 'btn-primary'}}">
                        {{ $user->is_admin ? '撤销管理员' : '设为管理员' }}
                    </button>
                </form>
            @endif
            @if(auth()->user()->is_admin && $user->id !== 1)
            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('确定要删除 {{ $user->name }} 吗？');">
                    删除
                </button>
            </form>
            @endif
        </div>
    @endif
</li>
