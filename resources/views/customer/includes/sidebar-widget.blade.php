<div class="sidebar-box">
    <h3 class="heading">Popüler Postlar</h3>
    <div class="post-entry-sidebar">
        <ul>
            {{-- sadece ilk üç post --}}

            @foreach ($catPost[1]->sortByDesc('hit')->take(3) as $post)
                @php
                    foreach ($post->postCategory as $postCategory) {
                        $category_id = $post->postCategory[0]->category_id;
                        foreach ($categories as $category) {
                            if ($category->id == $category_id) {
                                $category_name = Str::slug($category->name);
                            }
                        }
                    }
                @endphp
                <li>
                    <a href="">
                        <img src="{{ asset($post->image) }}" alt="Image placeholder" class="me-4 rounded">
                        <div class="text">
                            <h4>{{ $post->title }}</h4>
                            <div class="post-meta">
                                <span class="mr-2">
                                    {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- END sidebar-box -->

<div class="sidebar-box">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
        @foreach ($catPost[0]['category'] as $cat => $key)
            <li><a href="#">{{ $cat }} <span>({{ $key }})</span></a></li>
        @endforeach
    </ul>
</div>
<!-- END sidebar-box -->

<div class="sidebar-box">
    <h3 class="heading">Tags</h3>
    <ul class="tags">
        @foreach ($catPost[0]['tags'] as $tags)
            @foreach ($tags as $tag)
                <li><a href="#">{{ $tag }}</a></li>
            @endforeach
        @endforeach
    </ul>
</div>
