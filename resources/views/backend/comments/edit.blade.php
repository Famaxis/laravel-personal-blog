@extends('layouts.backend')

@section('content')
    <div class="container">
        <h1>Update Comment</h1>

        <form method="post" data-persist="garlic" action="{{ route('comments.update', $comment) }} ">
            @csrf
            <div class="form-group col-9">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" rows="3" class="input-block" minlength="2" maxlength="1000" required>{{ $comment->comment }}</textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="Update comment"/>
            </div>
        </form>
    </div>
@endsection