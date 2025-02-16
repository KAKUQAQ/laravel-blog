<li class="user-list-item">
    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}">
    <a href="{{ route('users.show', $user) }}">
        {{ $user->name }}
    </a>
</li>
