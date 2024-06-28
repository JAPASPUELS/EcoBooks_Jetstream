<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EcoBooks | Register</title>
    <link rel="icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('images/fondoRegistro.jpg') }}" alt="register form" class="img-fluid h-100" style="border-radius: 1rem 0 0 1rem; object-fit: cover;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('register') }}" autocomplete="off">
                                        @csrf

                                        <div class="d-flex flex-column align-items-center mb-3 pb-1">
                                            <img src="{{ asset('images/logo_EcoBooks.jpg') }}" alt="Logo del Negocio" class="img-fluid" style="max-width: 150px;">
                                            <!-- <span class="h1 fw-bold mb-0 mt-2">EcoBooks</span> -->
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Crea una cuenta nueva</h5>

                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <div class="form-outline mb-4">
                                            <input type="text" id="name" class="form-control form-control-lg" name="name" placeholder="Ej: Juan Perez" required autocomplete="off" autofocus />
                                            <label class="form-label" for="name">Nombre</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" class="form-control form-control-lg" name="email" placeholder="Ej: juan@example.com" required autocomplete="off" />
                                            <label class="form-label" for="email">Correo Electrónico</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="..." required autocomplete="new-password" />
                                            <label class="form-label" for="password">Contraseña</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password_confirmation" class="form-control form-control-lg" name="password_confirmation" placeholder="..." required autocomplete="new-password" />
                                            <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-custom btn-lg btn-block" type="submit">Registrar</button>
                                        </div>

                                        <div class="center-text">
                                            <a class="small text-muted" href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia Sesión</a>
                                        </div>
                                        <div class="center-text mt-3">
                                            <a class="btn btn-secondary" href="{{ route('login') }}">Regresar</a>
                                        </div>
                                        <p class="mt-5 small text-muted center-text">
                                            <a href="#!" class="small text-muted">Términos de uso.</a>
                                            <a href="#!" class="small text-muted">Política de privacidad</a>
                                        </p>
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