<x-app-layout>
    <div class="py-5"></div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-4">
                <div class="card login-box-container">
                    <div class="card-body">
                        <div class="authent-logo">
                            <a href="#">Neo</a>
                        </div>
                        <div class="authent-text">
                            <p>Welcome to Neo</p>
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input class="form-control" id="email" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username"
                                        placeholder="name@example.com">
                                    <label for="email" :value="__('Email')">E-Posta</label>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                            </div>
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input type="password" class="form-control" type="password" name="password" required
                                        autocomplete="current-password" placeholder="Password">
                                    <label for="password" :value="__('Password')">Şifre</label>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input"id="remember_me" type="checkbox"
                                    name="remember">
                                <label class="form-check-label"for="remember_me">Beni Hatırla</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs">Giriş Yap</button>
                            </div>
                        </form>
                        @if (Route::has('password.request'))
                            <div class="authent-reg">
                                <p>Şifreni mi unuttun? <a href="register.html">Yenile.</a></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
