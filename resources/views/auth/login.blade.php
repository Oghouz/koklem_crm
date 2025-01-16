<!DOCTYPE html>
<html lang="fr-FR" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRM - KOKLEM</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset('assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{asset('vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="{{asset('assets/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{asset('assets/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
  </head>
  <body>
    <main class="main" id="top">
      <div class="row vh-100 g-0">
        <div class="col-lg-6 position-relative d-none d-lg-block">
          <div class="bg-holder" style="background-image:url({{asset('images/login_background.jpg')}});">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="row flex-center h-100 g-0 px-4 px-sm-0">
            <div class="col col-sm-6 col-lg-7 col-xl-6">
            <form action="{{ route('login') }}" method="POST">
                @csrf
              <a class="d-flex flex-center text-decoration-none mb-4" href="{{asset('home')}}">
                <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block">
                    <img src="{{asset('images/logo.png')}}" alt="phoenix" width="58" />
                </div>
              </a>
              <div class="text-center mb-7">
                <h3 class="text-body-highlight">CRM KOKLEM</h3>
                <p class="text-body-tertiary">Accédez à votre compte</p>
              </div>
              <div class="mb-3 text-start">
                <label class="form-label" for="email">Adresse Email</label>
                <div class="form-icon-container">
                  <input class="form-control form-icon-input" id="email" name="email" type="email" placeholder="name@example.com" /><span class="fas fa-user text-body fs-9 form-icon"></span>
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
              </div>
              <div class="mb-3 text-start">
                <label class="form-label" for="password">Mot de passe</label>
                <div class="form-icon-container" data-password="data-password">
                  <input class="form-control form-icon-input pe-6" id="password" name="password" type="password" placeholder="Password" data-password-input="data-password-input" /><span class="fas fa-key text-body fs-9 form-icon"></span>
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <button class="btn px-3 py-0 h-100 position-absolute top-0 end-0 fs-7 text-body-tertiary" data-password-toggle="data-password-toggle"><span class="uil uil-eye show"></span><span class="uil uil-eye-slash hide"></span></button>
                </div>
              </div>
              <div class="row flex-between-center mb-7">
                <div class="col-auto">
                  <div class="form-check mb-0">
                    <input class="form-check-input" id="basic-checkbox" type="checkbox" checked="checked" />
                    <label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                  </div>
                </div>
              </div>
              <button class="btn btn-primary w-100 mb-3">Se connecter</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="{{asset('vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{asset('vendors/feather-icons/feather.min.js')}}"></script>
  </body>
</html>