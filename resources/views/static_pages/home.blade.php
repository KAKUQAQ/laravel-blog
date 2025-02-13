@extends('layout.default')
@section('title', 'KAKUQAQ')
@section('content')
<div class="container">
    <h1>KAKUQAQ</h1>
    <p>This is a blog for test, but you might want to become a member of it.</p>
    <a href="{{ route('signup') }}" class="btn btn-success signup-link">Signup</a>
    <div class="textarea-container">
        <textarea name="new-mes" id="new-mes" placeholder="Something new..."></textarea>
        <button type="submit" class="btn btn-success">submit</button>
    </div>
</div>
@endsection



