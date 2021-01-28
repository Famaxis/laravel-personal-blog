@extends('layouts.frontend')

@section('content')
    <div class="container">
        <article class="article">
            @foreach($posts as $post)


                    <div class="border border-primary margin padding-large
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
   border-primary background-primary border-4
@break

@default
  border-danger background-danger border-5
@endswitch
                            ">
                        <a href="{{ route('front.posts.show',$post->slug) }}">
                            <h1 class="article-title"><span class="title-link">{!! $post->title !!}</span></h1>
                        </a>

                        <div>
                            {!! $post->content !!}
                        </div>
                    </div>



            @endforeach

        </article>
        {!! $posts->links() !!}
    </div>

@endsection