@extends('layouts.backend')

@section('content')

    <div class="form-group margin-top">
        <a class="paper-btn" href="{{ route('pages.create') }}">Create page</a>
    </div>
    <table class="table-alternating">
        <thead>
        <th>Description</th>
        <th>Contents</th>
        <th>Title</th>
        <th>Template</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{!! $page->description!!}</td>
                <td>{!! $page->contents !!}</td>
                <td>{!! $page->title !!}</td>
                <td>{!! $page->template !!}</td>
                <td>
{{--                    <a href="{{ route('front.pages.show',$page->slug) }}" class="paper-btn btn-secondary-outline">Read</a>--}}
                    <a href="{{ route('pages.edit', $page->slug) }}" class="paper-btn btn-success-outline">Edit</a>
                    <form action="{{route('pages.destroy', $page->slug)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="paper-btn btn-danger-outline">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $pages->links() !!}
@endsection