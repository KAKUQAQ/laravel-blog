<form action="{{ route('statuses.store') }}" method="POST">
    @include('shared._errors')
    {{ csrf_field() }}
    <div class="textarea-container">
        <label for="content">
            <textarea name="content" id="content" placeholder="Something new..."></textarea>
            <button type="submit" class="btn btn-success submit-button">submit</button>
        </label>
    </div>
</form>
