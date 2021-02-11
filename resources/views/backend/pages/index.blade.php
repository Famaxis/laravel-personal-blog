@extends('layouts.backend')

@section('content')

    <table class="table-alternating">
        <thead>
        <th>Description</th>
        <th>Post</th>
        <th style="min-width: 10rem;">Tags</th>
        <th>First Sentence</th>
        <th>Template</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr @if(!$page->is_published)
                    class="unpublished"
                @endif
            >
                <td>{!! $page->description!!}</td>
                <td>{!! $page->content !!}</td>
                <td>
                    @foreach($page->tags as $tag)
                        <a class="paper-btn btn-small"
                           href="{{ route('pages.fetch', $tag->slug) }}">{!! $tag->name !!}</a>
                    @endforeach
                </td>
                <td>{!! $page->first_sentence !!}</td>
                <td>{!! $page->template !!}</td>
                <td>
                    <a href="{{ route('front.pages.show',$page->slug) }}" class="paper-btn btn-secondary-outline">Read</a>
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