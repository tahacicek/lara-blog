<x-guest-layout>
    @section('title', 'Anasayfa')
    @section('css')
    @endsection

    <div class="section search-result-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">Kategori: {{ $category->name }}
                        <p class="mt-3">
                            {{ $category->description }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row posts-entry">
                <div class="col-lg-8">
                    @foreach ($posts as $post)
                    <div class="blog-entry d-flex blog-entry-search-item">
                        <a href="{{ route('post.detail', [$category->slug, $post->post->slug]) }}" class="img-link me-4">
                            <img src="{{ asset($post->post->image) }}" alt="Image" class="img-fluid">
                        </a>
                        <div>
                            <span class="date">{{ \Carbon\Carbon::parse($post->post->created_at)->format('d M Y') }}</span> &bullet; <a href="#">{{ $category->name }}</a></span>
                            <h2><a href="{{ route('post.detail', [$category->slug, $post->post->slug]) }}">{{ $post->post->title }}</a></h2>
                            <p>{!! Str::limit($post->post->content, 100) !!}</p>
                            <p><a href="{{ route('post.detail', [$category->slug, $post->post->slug]) }}" class="btn btn-sm btn-outline-primary">Read More</a></p>
                        </div>
                    </div>
                    @endforeach
                    <!-- END blog entry -->
                    {{-- paginate --}}

                    <span class="d-flex ">
                        {!! $posts->links() !!}
                    </span>
                </div>
                <div class="col-lg-4 sidebar">
                    <div class="sidebar-box search-form-wrap mb-4">
                        <form action="#" class="sidebar-search-form">
                            <span class="bi-search"></span>
                            <input type="text" class="form-control" id="s"
                                placeholder="Type a keyword and hit enter">
                        </form>
                    </div>
                    @include('customer.includes.sidebar-widget')
                </div>
            </div>
        </div>
    </div>
    @section('js')
    @endsection
</x-guest-layout>
