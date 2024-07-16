<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EcoBooks | Login</title>
    <link rel="icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <link href="{{ asset('css/login.css') }}" rel="stylesheet"> <!-- Incluir el CSS personalizado -->
</head>

<body class="bg-gray-50">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('images/image.png') }}" alt="login form" class="img-fluid h-100"
                                    style="border-radius: 1rem 0 0 1rem; object-fit: cover;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <a href="/" class="bg-gray-700 no-underline ">
                                        <h5 class="no-underline text-normal">Atrás</h5>
                                    </a>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif



                                        <div class="d-flex flex-column align-items-center pb-1 ">
                                            {{-- <img src="{{ asset('images/logo_EcoBooks.jpg') }}" alt="Logo del Negocio" --}}
                                                {{-- class="img-fluid" style="max-width: 150px;"> --}}
                                            <span class="h1 fw-bold mb-0 mt-2">EcoBooks</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px;">Iniciar
                                            Sesión</h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" class="form-control form-control-lg"
                                                name="email" required autocomplete="email" autofocus />
                                            <label class="form-label" for="email">Correo</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" class="form-control form-control-lg"
                                                name="password" required autocomplete="new-password" />
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label class="form-label mb-0" for="password">Contraseña</label>
                                                <a href="{{ route('password.option') }}">¿Olvidaste la contraseña?</a>
                                            </div>
                                        </div>

                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                Recuérdame
                                            </label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-custom btn-lg btn-block"
                                                type="submit">Iniciar</button>
                                        </div>


                                        <div class="left-text">
                                            <laber class="mb-0 pb-lg-1">¿No tienes cuenta aún?</label>
                                                <span class="highlight-link">Comunicate con Administración</span>
                                                {{-- <a href="{{ route('register') }}" class="highlight-link">Regístrese aquí</a>
                                                <div class="center-text mt-3">
                                                    <a href="#!" class="small text-muted d-block">Términos de uso.</a>
                                                    <a href="#!" class="small text-muted d-block">Política de privacidad</a>
                                                </div> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
