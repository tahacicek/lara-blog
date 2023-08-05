<div class="pt-5 comment-wrap">
    <h3 class="mb-5 heading">6 Comments</h3>
    <ul class="comment-list">
        @foreach ($comments as $comment)
            <li id="{{ $comment->id }}" class="comment">
                <div class="vcard">
                    <img src="{{ asset($comment->user->avatar) }}" alt="Image placeholder">
                </div>
                <div class="comment-body">
                    <h3>{{ $comment->user->name }}</h3>
                    <div class="meta">
                        {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                    </div>
                    <p>
                        {{ $comment->body }}
                    </p>
                    <p>
                        @if ($comment->user_id == Auth::user()->id)
                            <button id="deleteComment" type="button" data-comment="{{ $comment->id }}"
                                class="reply rounded bg-danger"><i class="fa text-white fa-trash"
                                    aria-hidden="true"></i></button>
                        @endif
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="comment-form-wrap pt-5">
        <h3 class="mb-5">Leave a comment</h3>
        <form id="comment" class="p-5 bg-light">
            <div class="form-group">
                <input type="text" class="form-control" id="post_id" name="post_id" value="{{ $post->id }}"
                    hidden>
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
@section('js')
    <script>
        $(document).ready(function() {
            $('#comment').on('submit', function(e) {
                e.preventDefault();
                var post_id = $('#post_id').val();
                var body = $('#body').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('comment') }}",
                    type: "POST",
                    data: {
                        post_id: post_id,
                        body: body,
                        _token: _token,
                        type: 'comment-post'
                    },
                    success: function(response) {
                        if (response) {
                            $('#comment').trigger('reset');
                            $('.comment-list').prepend(
                                '<li class="comment"><div class="vcard"><img src="{{ asset(Auth::user()->avatar) }}" alt="Image placeholder"></div><div class="comment-body"><h3>{{ Auth::user()->name }}</h3><div class="meta">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</div><p>' +
                                body +
                                '</p><p><a href="#" class="reply rounded bg-danger"><i class="fa text-white fa-trash" aria-hidden="true"></i></a></p></div></li>'

                            );
                            // izitoas
                            iziToast.success({
                                title: 'OK',
                                message: 'Comment added!',
                                position: 'topRight'
                            });
                        }
                    }
                });
            });

            // deleteComment with izitoast questions
            $('#deleteComment').on('click', function(e) {
                console.log('test');
                e.preventDefault();
                var comment = $(this).data('comment');

                var _token = $('input[name="_token"]').val();
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Hey',
                    message: 'Are you sure about that?',
                    position: 'center',
                    buttons: [
                        ['<button><b>YES</b></button>', function(instance, toast) {
                            $.ajax({
                                url: "{{ route('comment') }}",
                                type: "POST",
                                data: {
                                    comment: comment,
                                    _token: _token,
                                    type: 'delete-comment'
                                },
                                success: function(response) {
                                    // izitoastı kapat
                                    instance.hide({
                                        transitionOut: 'fadeOutUp'
                                    }, toast, 'button');
                                    // commentı sil
                                    $('#' + comment).remove();
                                    if (response) {
                                        iziToast.success({
                                            title: 'OK',
                                            message: 'Comment deleted!',
                                            position: 'topRight'
                                        });
                                    }
                                }
                            });
                        }, true],
                        ['<button>NO</button>', function(instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp'
                            }, toast, 'button');
                        }],
                    ]
                });
            });
        });
    </script>
@endsection
