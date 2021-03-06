@extends('layouts.frontend')

@section('content')
        @if(Route::current()->getName() === 'front.posts.fetch')
            <h2>Posts tagged with {!! $tag->name !!}</h2>
        @endif

            @foreach($posts as $post)
                <div class="border border-primary row flex-edges margin padding-large
@switch($loop->iteration)
                @case(1)
                        border-secondary background-secondary
@break

                @case(2)
                        border-success background-success border-2
@break

                @case(3)
                        border-warning background-warning border-3
@break

                @case(4)
                        border-danger background-danger border-5
@break

                @default
                        border-primary background-primary border-4
@endswitch
                        ">

                    <div class="sm-6 md-8 lg-11">
                        @if($post->description)
                            {!! $post->description !!}
                        @else
                            {!! $post->contents !!}
                        @endif

                        <p class="tags">
                            @foreach($post->tags as $tag)
                                <a class="paper-btn btn-small"
                                   href="{{ route('front.posts.fetch', $tag->slug) }}">{!! $tag->name !!}</a>
                            @endforeach
                        </p>

                            @if($post->comments_count > 0)
                                <p>
                                    <a href="{{ route('front.resource.show', $post->slug) . '#comments' }}">{{ trans_choice('comments.count', $post->comments_count) }}</a>
                                </p>
                            @endif

                    </div>
                    <a href="{{ route('front.resource.show',$post->slug) }}" class="read-more
sm-6 md-4 lg-1 col flex-center">
                        <svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'><path fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='48' d='M184 112l144 144-144 144'/></svg>
                    </a>
                </div>
            @endforeach
        {!! $posts->links() !!}
@endsection