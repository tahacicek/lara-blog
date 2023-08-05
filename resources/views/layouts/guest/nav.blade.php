<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <a href="index.html" class="logo m-0 float-start">LBlog<span class="text-primary">.</span></a>
                    </div>
                    <div class="col-6 text-center">
                        <form action="#" class="search-form d-inline-block d-lg-none">
                            <input type="text" class="form-control" placeholder="Ara...">
                            <span class="bi-search"></span>
                        </form>
                        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                            @foreach ($categories as $category)
                                {{-- ilk dört kategori --}}
                                @if ($loop->index < 4)
                                    <li><a
                                            href="{{ route('category.detail', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endif
                                @if ($loop->index == 3)
                                    <li class="has-children">
                                        <a href="{{ route('category.detail', $category->slug) }}">Diğerleri</a>
                                        <ul class="dropdown">
                                @endif
                                {{-- ilk dört kategori dışındakiler --}}
                                @if ($loop->index > 3)
                                    <li><a href="{{ route('category.detail', $category->slug) }}">
                                            {{ $category->name }}</a></li>
                                @endif
                                {{-- bu aralıktaki kodu foreacha sokama --}}
                            @endforeach
                        </ul>
                        </li>
                        </ul>
                    </div>
                    <div class="col-1 text-end ">
                        <a href="#"
                            class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                            <span></span>
                        </a>
                        <form action="#" class="search-form d-none d-lg-inline-block">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="bi-search"></span>
                        </form>
                    </div>
                    <div class="col-2 text-end me-1 d-none d-lg-inline-block">
                        @if (Auth::check())
                            <div class="dropdown">
                                <a class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="bi bi-person">{{ Auth::user()->name }}</span>
                                </a>
                                <ul style="width: 153px; padding: 10px;" class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item active" href="#">Profil</a></li>
                                    <li><a class="dropdown-item" href="#">Ayarlar</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a style="cursor: pointer" class="dropdown-item" :href="route('logout')"
                                                onclick="event.preventDefault();
                                                    this.closest('form').submit();">Çıkış
                                                Yap</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="dropdown">
                                <a class="btn btn-light " href="{{ route('login') }}">
                                    <span class="bi bi-person">Giriş Yap</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
