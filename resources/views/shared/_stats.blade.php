<div class="stats-container">
    <div class="stats-item">
        <a href="{{ route('users.followings', $user->id) }}">
            <span class="stats-count">{{ $user->followings()->count() }}</span>
            关注
        </a>
    </div>
    <span class="stats-separator">|</span>
    <div class="stats-item">
        <a href="{{ route('users.followers', $user->id) }}">
            <span class="stats-count">{{ $user->followers()->count() }}</span>
            粉丝
        </a>
    </div>
    <span class="stats-separator">|</span>
    <div class="stats-item">
        <a href="{{ route('users.show', $user->id) }}">
            <span class="stats-count">{{ $user->statuses()->count() }}</span>
            动态
        </a>
    </div>
</div>
