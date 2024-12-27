<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">

    <title>CRM KOKLEM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
    body {
        background: url({{asset('images/login_background.jpg')}}) no-repeat center center fixed;
        background-size: cover
        height: 100vh";
    }
    #login .container #login-row #login-column #login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 350px;
        border-radius: 10px;
        background-color: #EAEAEA;
    }
    #login .container #login-row #login-column #login-box #login-form {
        padding: 20px;
    }
    #login .container #login-row #login-column #login-box #login-form #register-link {
        margin-top: -85px;
    }    
</style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="login">
        <h1 class="text-center text-secondary pt-5">KOKLEM</h1>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h3 class="text-center p-3">DASHBOARD</h3>
                            <div class="form-group">
                                <label for="email">Identifiant:</label><br>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe:</label><br>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Se connecter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript"></script>
</body>
</html>