<p>Leave a comment</p>
<form action="{{ route('comment.store', $post->id) }}" data-persist="garlic" method="POST">
    @csrf
    <div class="row flex-right">
        <div class="form-group col-3">
            <label for="name">Nickname (optional)</label>
            <input type="text" name="name" id="name" maxlength="200">
        </div>
        <div class="form-group col-9">
            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" rows="3" class="input-block" minlength="2" maxlength="1000" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="paper-btn btn-secondary" value="Comment">
        </div>
    </div>
</form>
