@can('follow', $user)
    <div class="follow-form">
        @if (Auth::user()->isFollowing($user->id))
            <form action="{{ route('followers.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-unfollow">取消关注</button>
            </form>
        @else
            <form action="{{ route('followers.store', $user->id) }}" method="POST">
                @csrf
                <button type="submit">关注</button>
            </form>
        @endif
    </div>
@endcan
