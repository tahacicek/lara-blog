<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <a href="index.html" class="logo m-0 float-start">LBlog<span class="text-primary">.</span></a>
                    </div>
                    <div class="col-8 text-center">
                        <form action="#" class="search-form d-inline-block d-lg-none">
                            <input type="text" class="form-control" placeholder="Ara...">
                            <span class="bi-search"></span>
                        </form>
                        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                            @foreach ($categories as $category)
                                {{-- ilk dört kategori --}}
                                @if ($loop->index < 4)
                                    <li><a href="{{ route('category', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endif
                                @if ($loop->index == 3)
                                    <li class="has-children">
                                        <a href="{{ route('category', $category->slug) }}">Diğerleri</a>
                                        <ul class="dropdown">
                                @endif
                                {{-- ilk dört kategori dışındakiler --}}
                                @if ($loop->index > 3)
                                    <li><a href="{{ route('category', $category->slug) }}">
                                            {{ $category->name }}</a></li>
                                @endif
                                {{-- bu aralıktaki kodu foreacha sokama --}}
                            @endforeach
                        </ul>
                        </li>
                        </ul>
                    </div>
                    <div class="col-2 text-end">
                        <a href="#"
                            class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                            <span></span>
                        </a>
                        <form action="#" class="search-form d-none d-lg-inline-block">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bi-search"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
