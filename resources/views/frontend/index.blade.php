@extends('layouts.front')

@section('content')

    <div class="container-fluid">
        <div class="row no-gutter">


            <div class="container">
                <div class="row row-cols-3">

                    @foreach($posts as $post)
                        <div class="col">
                            {!! $post->content !!}
                            <div>
                                <a href="{{ route('front.show',$post->slug) }}"
                                   class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">Show Post</a>
                            </div>
                        </div>
                    @endforeach

                </div>
                {!! $posts->links() !!}
            </div>
        </div>
    </div>

@endsection