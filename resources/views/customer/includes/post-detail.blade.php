<x-guest-layout>
    @section('title', 'Anasayfa')
    @section('css')
    @endsection
    <div class="site-cover site-cover-sm same-height overlay single-page"
        style="background-image: url('{{ asset($post->image) }}');">
        <div class="container">
            <div class="row same-height justify-content-center">
                <div class="col-md-6">
                    <div class="post-entry text-center">
                        <h1 class="mb-4">{{ $post->title }}</h1>
                        <div class="post-meta align-items-center text-center">
                            <figure class="author-figure mb-0 me-3 d-inline-block"><img src="{{ asset($user->avatar) }}"
                                    alt="Image" class="img-fluid"></figure>
                            <span class="d-inline-block mt-1">{{ '@' . $user->username }}</span>
                            <span>&nbsp;-&nbsp;
                                {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                            </span>
                            &nbsp;-&nbsp;
                            <span class="d-inline-block mt-">
                                <i class="fa fa-eye mt-2"></i> {{ $post->hit > 0 ? $post->hit : 0 }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <div class="row blog-entries element-animate">
                <div class="col-md-12 col-lg-8 main-content">
                    <div class="post-content-body">
                        {{-- <div class="row my-4">
                  <div class="col-md-12 mb-4">
                    <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded">
                  </div>
                  <div class="col-md-6 mb-4">
                    <img src="images/img_2_horizontal.jpg" alt="Image placeholder" class="img-fluid rounded">
                  </div>
                  <div class="col-md-6 mb-4">
                    <img src="images/img_3_horizontal.jpg" alt="Image placeholder" class="img-fluid rounded">
                  </div>
                </div> --}}
                        <p>
                            {!! $post->content !!}
                        </p>
                    </div>
                    <div class="pt-5">
                        <p>Kategori :
                            @foreach ($postTagCat['category'] as $cat)
                                <a href="#" class="">{{ $cat }}</a>
                            @endforeach
                            Etiket :
                            @foreach ($postTagCat['tags'] as $tag)
                                <a href="#" class="">#{{ $tag }}</a>
                            @endforeach
                        </p>
                    </div>
                    @include('customer.includes.comment')
                </div>
                <!-- END main-content -->
                <div class="col-md-12 col-lg-4 sidebar">
                    <div class="sidebar-box search-form-wrap">
                        <form action="#" class="sidebar-search-form">
                            <span class="bi-search"></span>
                            <input type="text" class="form-control" id="s"
                                placeholder="Type a keyword and hit enter">
                        </form>
                    </div>
                    <!-- END sidebar-box -->
                    <div class="sidebar-box">
                        <div class="bio text-center">
                            <img src="{{ asset($user->avatar) }}" alt="Image Placeholder" class="img-fluid mb-3">
                            <div class="bio-body">
                                <h2>{{ $user->name }}</h2>
                                <p class="mb-4">{{ Str::limit($user->bio, 50) }}</p>
                                <p><a href="#" class="btn btn-primary btn-sm rounded px-2 py-2">Bio'ma devam
                                        et..</a>
                                </p>
                                <p class="social">
                                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END sidebar-box -->
                    @include('customer.includes.sidebar-widget')
                </div>
                <!-- END sidebar -->
            </div>
        </div>
    </section>
    <!-- Start posts-entry -->
    <section class="section posts-entry posts-entry-sm bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-uppercase text-black">More Blog Posts</div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="blog-entry">
                        <a href="single.html" class="img-link">
                            <img src="images/img_1_horizontal.jpg" alt="Image" class="img-fluid">
                        </a>
                        <span class="date">Apr. 14th, 2022</span>
                        <h2><a href="single.html">Thought you loved Python? Wait until you meet Rust</a></h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <p><a href="#" class="read-more">Continue Reading</a></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="blog-entry">
                        <a href="single.html" class="img-link">
                            <img src="images/img_2_horizontal.jpg" alt="Image" class="img-fluid">
                        </a>
                        <span class="date">Apr. 14th, 2022</span>
                        <h2><a href="single.html">Startup vs corporate: What job suits you best?</a></h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <p><a href="#" class="read-more">Continue Reading</a></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="blog-entry">
                        <a href="single.html" class="img-link">
                            <img src="images/img_3_horizontal.jpg" alt="Image" class="img-fluid">
                        </a>
                        <span class="date">Apr. 14th, 2022</span>
                        <h2><a href="single.html">UK sees highest inflation in 30 years</a></h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <p><a href="#" class="read-more">Continue Reading</a></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="blog-entry">
                        <a href="single.html" class="img-link">
                            <img src="images/img_4_horizontal.jpg" alt="Image" class="img-fluid">
                        </a>
                        <span class="date">Apr. 14th, 2022</span>
                        <h2><a href="single.html">Don’t assume your user data in the cloud is safe</a></h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <p><a href="#" class="read-more">Continue Reading</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @section('js')

    @endsection
</x-guest-layout>
