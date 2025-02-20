<form action="{{ route('statuses.store') }}" method="POST" class="status-form">
    @include('shared._errors')
    @csrf
    <label for="content">发布新动态</label>
    <textarea name="content" id="content" placeholder="分享你的想法..." required></textarea>
    <button type="submit" class="submit-button">发布</button>
</form>
