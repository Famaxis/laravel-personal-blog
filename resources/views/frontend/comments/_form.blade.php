<form action="{{ route('comment.store', $post->id) }}" data-persist="garlic" method="POST">
    @csrf
    <input type="text" name="name"  id="name">
    <textarea id="comment" name="comment" rows="3" required></textarea>
    <div class="form-group">
        <input type="submit" class="paper-btn btn-secondary" value="Comment">
    </div>
</form>