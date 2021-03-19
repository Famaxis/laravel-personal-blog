@if($chosenPosts)
    <div class="card margin-top-large margin-right-large" style="width: 20rem;">
        <div class="card-body">
            <h4 class="card-title">@lang('aside.choice')</h4>
            @foreach($chosenPosts as $post)
                <a href="{{ route('front.resource.show', $post->slug) }}">
                    {{ $post->first_sentence }}
                </a>
            @endforeach
        </div>
    </div>
@endif
