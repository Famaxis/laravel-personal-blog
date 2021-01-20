@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                    <th>Comment</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->comment}}</td>
                            <td>
                                <form action="{{route('comment.destroy', $comment)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger py-0">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

                {!! $comments->links() !!}
            </div>
        </div>
    </div>
@endsection