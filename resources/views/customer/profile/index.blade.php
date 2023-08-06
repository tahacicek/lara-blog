<x-guest-layout>
    @section('title', 'Anasayfa')
    @section('css')
    <style>
        .nav-item{
            margin-right: 15px;
        }

        .nav-item button{
            background-color: #fff;
            border: none;
            border-radius: 0;
            color: #000;
            font-size: 18px;
            padding: 10px 20px;
        }

        .nav-item button:hover{
            background-color: #000;
            color: #fff;
        }

        .profile-user{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .profile-user-img{
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .profile-user-img img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-user-info{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .profile-user-info h4{
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .profile-user-info p{
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 5px;
        }

        .profile-settings{
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .profile-settings .form-label{
            font-size: 18px;
            font-weight: 600;
        }

        .profile-settings .form-control{
            margin-bottom: 20px;
        }

        .profile-settings .btn-primary{
            background-color: #000;
            border: none;
            border-radius: 0;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .profile-settings .btn-primary:hover{
            background-color: #fff;
            color: #000;
        }
    </style>
    @endsection
    <section class="section bg-light">
        <div class="container">
            <div class="row align-items-stretch retro-layout">
                <ul class="nav-tabs mt-5 nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                    </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="profile-settings">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Ad Soyad</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">E-Posta</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Telefon</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Adres</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="avatar" class="form-label">Profil Resmi</label>
                                            <input type="file" class="form-control" id="avatar" name="avatar">
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Güncelle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="profile-user">
                                    <div class="profile-user-img">
                                        <img src="{{ asset(Auth::user()->avatar) }}" alt="">
                                    </div>
                                    <div class="profile-user-info">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p>{{ Auth::user()->email }}</p>
                                        <p>{{ Auth::user()->phone }}</p>
                                        <p>{{ Auth::user()->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...b</div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...d</div>
                  </div>
            </div>
        </div>
    </section>
    @section('js')
    @endsection
</x-guest-layout>
