<p><span class="mini-heading">@lang('comments.leave comment')</span></p>

@auth
    <form action="{{ route('comment.store_for_admin', $resource->id) }}" data-persist="garlic" method="POST">
        @csrf
        <div class="row flex-right">
            <div class="form-group col-12">
                <label for="comment">@lang('comments.comment'):</label>
                <textarea id="comment" name="comment" rows="3" class="input-block"></textarea>
            </div>
            <div class="form-group col">
                <input type="submit" class="paper-btn btn-secondary" value="Comment">
            </div>
        </div>
    </form>
@endauth

@guest
    <form action="{{ route('comment.store', $resource->id) }}" data-persist="garlic" method="POST">
        @csrf

        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif

        <div class="row flex-right">
            <div class="form-group col-3">
                <label for="name">Nickname (optional):</label>
                <input type="text" name="name" id="name" maxlength="200">
            </div>
            <div class="form-group col-9">
                <label for="comment">@lang('comments.comment'):</label>
                <textarea id="comment" name="comment" rows="3" class="input-block" minlength="2" maxlength="1000"
                          required></textarea>
            </div>

            <label class="email" for="email"></label>
            <input class="email" autocomplete="off" type="email" id="email" name="email" placeholder="Your e-mail">

            <label class="website" for="website"></label>
            <input class="website" autocomplete="off" type="text" id="website" name="website" placeholder="Your website">

            <div class="form-group">
                <input type="submit" class="paper-btn btn-secondary" value="@lang('comments.to comment')">
            </div>
        </div>
    </form>
@endguest