@can('follow', $user)
    <div>
        @if(Auth::user()->isFollowing($user->id))
            <form action="{{ route('follower.destroy', $user->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit">取消关注</button>
            </form>
        @else
            <form action="{{ route('followers.store', $user->id) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit">关注</button>
            </form>
        @endif
    </div>
@endcan
