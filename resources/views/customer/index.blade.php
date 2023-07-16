<x-guest-layout>
    @section('title', 'Anasayfa')
    @section('css')
    @endsection
    <section class="section bg-light">
        <div class="container">
            <div class="row align-items-stretch retro-layout">
                <div class="col-md-4">
                    {{-- buraya son iki post dizilecek --}}
                    @foreach ($posts->sortByDesc('created_at')->take(2) as $post)
                        <a href="" class="h-entry mb-30 v-height gradient"
                            style="background-image: url('{{ $post->image }}');">

                            <div class="text">
                                <span class="date">{{ $post->created_at->format('M d, Y') }}</span>
                                <h2>{{ $post->title }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="col-md-4">
                    {{-- buraya 3. post --}}
                    @foreach ($posts->sortByDesc('created_at')->skip(2)->take(1) as $post)
                        <a href="" class="h-entry img-5 h-100 gradient"
                            style="background-image: url('{{ $post->image }}');">

                            <div class="text">
                                <div class="post-categories mb-3">
                                    <span class="post-category bg-danger"></span>
                                </div>
                                <span class="date">{{ $post->created_at->format('M d, Y') }}</span>
                                <h2>{{ $post->title }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="col-md-4">
                    {{-- buraya 4. ve 5. postlar  --}}
                    @foreach ($posts->sortByDesc('created_at')->skip(3)->take(2) as $post)
                        <a href="" class="h-entry mb-30 v-height gradient"
                            style="background-image: url('{{ $post->image }}');">

                            <div class="text">
                                <span class="date">{{ $post->created_at->format('M d, Y') }}</span>
                                <h2>{{ $post->title }}</h2>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End retroy layout blog posts -->
    @foreach ($catPost as $key => $value)
        <section class="section">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h2 class="posts-entry-title">
                            @foreach ($categories as $category)
                                @if ($category->order == $key)
                                    {{ $category->name }}
                                @endif
                            @endforeach
                            <h2>
                    </div>
                    <div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">Hepsini Göster</a>
                    </div>
                </div>
                <div class="row">
                    @foreach ($value as $post)
                        <div class="col-lg-4 mb-4">
                            <div class="post-entry-alt">
                                <a href="single.html" class="img-link"><img src="{{ asset($post->post->image) }}"
                                        alt="Image" class="img-fluid"></a>
                                <div class="excerpt">
                                    <h2><a href="single.html">{{ $post->post->title }}</a>
                                    </h2>
                                    <div class="post-meta align-items-center text-left clearfix">
                                        <figure class="author-figure mb-0 me-3 float-start"><img
                                                src="{{ asset($post->post->image) }}" alt="Image" class="img-fluid">
                                        </figure>
                                        <span class="d-inline-block mt-1">By <a href="#">Taha Çiçek</a></span>
                                        <span>&nbsp;-&nbsp;
                                            {{ $post->post->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                    <p>
                                        {!! Str::limit($post->post->content, 100) !!}
                                    </p>
                                    <p><a href="#" class="read-more">Okumaya devam et</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
    <div class="section bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">Travel</h2>
                </div>
                <div class="col-sm-6 text-sm-end"><a href="category.html" class="read-more">View All</a></div>
            </div>
            <div class="row align-items-stretch retro-layout-alt">
                <div class="col-md-5 order-md-2">
                    <a href="single.html" class="hentry img-1 h-100 gradient">
                        <div class="featured-img" style="background-image: url('images/img_2_vertical.jpg');"></div>
                        <div class="text">
                            <span>February 12, 2019</span>
                            <h2>Meta unveils fees on metaverse sales</h2>
                        </div>
                    </a>
                </div>
                <div class="col-md-7">
                    <a href="single.html" class="hentry img-2 v-height mb30 gradient">
                        <div class="featured-img" style="background-image: url('images/img_1_horizontal.jpg');"></div>
                        <div class="text text-sm">
                            <span>February 12, 2019</span>
                            <h2>AI can now kill those annoying cookie pop-ups</h2>
                        </div>
                    </a>
                    <div class="two-col d-block d-md-flex justify-content-between">
                        <a href="single.html" class="hentry v-height img-2 gradient">
                            <div class="featured-img" style="background-image: url('images/img_2_sq.jpg');"></div>
                            <div class="text text-sm">
                                <span>February 12, 2019</span>
                                <h2>Don’t assume your user data in the cloud is safe</h2>
                            </div>
                        </a>
                        <a href="single.html" class="hentry v-height img-2 ms-auto float-end gradient">
                            <div class="featured-img" style="background-image: url('images/img_3_sq.jpg');"></div>
                            <div class="text text-sm">
                                <span>February 12, 2019</span>
                                <h2>Startup vs corporate: What job suits you best?</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('js')
    @endsection
</x-guest-layout>
