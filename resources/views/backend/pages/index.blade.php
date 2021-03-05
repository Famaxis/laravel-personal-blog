@extends('layouts.backend')

@section('content')

    <div class="form-group margin-top">
        <a class="paper-btn" href="{{ route('pages.create') }}">Create page</a>
    </div>
    <table class="table-alternating">
        <thead>
        <th>Title</th>
        <th>Description</th>
        <th>Contents</th>
        <th>Template</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>{!! $page->title !!}</td>
                <td>{!! $page->description!!}</td>
                <td>{!! $page->contents !!}</td>
                <td>{!! $page->default_template !!}</td>
                <td>
                    <a href="{{ route('front.resource.show',$page->slug) }}" class="paper-btn btn-secondary-outline">Read</a>
                    <a href="{{ route('pages.edit', $page->slug) }}" class="paper-btn btn-success-outline">Edit</a>
                    <form action="{{route('pages.destroy', $page->slug)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="paper-btn btn-danger-outline"
                                @if($settings->confirm_deletion)
                                onclick="return confirm('Are you sure?')"
                                @endif
                        >Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $pages->links() !!}
@endsection