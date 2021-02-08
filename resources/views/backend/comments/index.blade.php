@extends('layouts.backend')

@section('content')
                <table class="table-alternating">
                    <thead>
                    <th>Nickname</th>
                    <th>Comment</th>
                    <th>Action</th>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>
                                <a href="{{ route('front.posts.show', $comment->post->slug) . '#' . $comment->created_at->format('Y-m-d_h-i-s') }}" class="paper-btn btn-secondary-outline">Read</a>
                                <a href="{{ route('comments.edit', $comment) }}" class="paper-btn btn-success-outline">Edit</a>
                                <form action="{{route('comments.destroy', $comment)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="paper-btn btn-danger-outline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

                {!! $comments->links() !!}

@endsection