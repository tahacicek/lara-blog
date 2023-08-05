<div class="pt-5 comment-wrap">
    <h3 class="mb-5 heading">6 Comments</h3>
    <ul class="comment-list">
        <li class="comment">
            <div class="vcard">
                <img src="images/person_1.jpg" alt="Image placeholder">
            </div>
            <div class="comment-body">
                <h3>Jean Doe</h3>
                <div class="meta">January 9, 2018 at 2:21pm</div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum
                    necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim
                    sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                <p><a href="#" class="reply rounded">Reply</a></p>
            </div>
        </li>
    </ul>
    <div class="comment-form-wrap pt-5">
        <h3 class="mb-5">Leave a comment</h3>
        <form id="comment" class="p-5 bg-light">
            <div class="form-group">
                <input type="text" class="form-control" id="post_id" name="post_id" value="{{ $post->id }}" hidden>
            </div>
            <div class="form-group">
                <label for="body">Message</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Post Comment" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
