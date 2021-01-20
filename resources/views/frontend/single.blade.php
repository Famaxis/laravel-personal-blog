@extends('layouts.front')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {!! $post->content !!}
                    </div>

                    <div class="card-body">
                        <h5>Display Comments</h5>

                        @include('frontend.partials.replies', ['comments' => $post->comments, 'post_id' => $post->id])

                        <hr />
                    </div>

                    <div class="card-body">
                        <h5>Leave a comment</h5>
                        <form method="post" action="{{ route('comment.add') }}">
                            @csrf
                            <div class="form-group">
                                <textarea name="comment" class="form-control" cols="40" rows="1" minlength="2" maxlength="1000" required></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />

                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection