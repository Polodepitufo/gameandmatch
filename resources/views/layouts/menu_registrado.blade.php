<!DOCTYPE html>
<html lang="es">

<!--Head-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" type="image/png" />
    <!--Enlace bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Enlace css propio-->
    <link href="{{ asset('custom.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>@yield('title')</title>
    @livewireStyles
</head>

<body>
    <!--Header y menú-->
    <div id='id-top-bar' class="d-flex flex-row-reverse align-items-center">


        <small><a href="{{ route('logout') }}" class="mr-3">
                Cerrar sesión</a>
        </small>

        <small> <a href="{{ route('profile.edit') }}">Ajustes</a></small>
    </div>

    <!--Header y menú-->
    <header id='id-header' class="pb-0 d-flex  bg-light-color sticky-top navbar-expand-lg  navbar">
        <ul class="navbar-nav">

            <a href="{{ route('dashboard') }}">
                <li class="p-4 mb-0">
                    GAME&MATCH
                </li>
            </a>

        </ul>

        <button class="navbar-toggler mx-4" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <nav class="collapse  navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                @if (Auth::user()->rol == 'USUARIO')
                    <a href="{{ route('library.list') }}">
                        <li class="p-4 mb-0">
                            BIBLIOTECA
                        </li>
                    </a>
                    <a href="{{ route('match.list') }}">
                        <li class="p-4 mb-0">
                            MATCH
                        </li>
                    </a>
                    <a href="{{ route('search.list') }}">
                        <li class="p-4 mb-0">
                            BUSCAR USUARIO
                        </li>
                    </a>
                @endif
                @if (Auth::user()->rol == 'ADMIN')
                    <a href="{{ route('game.list') }}">
                        <li class="p-4 mb-0">
                            JUEGOS
                        </li>
                    </a>
                    <a href="{{ route('genre.list') }}">
                        <li class="p-4 mb-0">
                            GÉNEROS
                        </li>
                    </a>
                    <a href="{{ route('category.list') }}">
                        <li class="p-4 mb-0">
                            CATEGORIAS
                        </li>
                    </a>
                @endif
                @if (Auth::user()->rol == 'SUPERAD')
                    <a href="{{ route('user.list') }}">
                        <li class="p-4 mb-0">
                            USUARIOS
                        </li>
                    </a>
                    <a href="{{ route('game.list') }}">
                        <li class="p-4 mb-0">
                            JUEGOS
                        </li>
                    </a>
                    <a href="{{ route('genre.list') }}">
                        <li class="p-4 mb-0">
                            GÉNEROS
                        </li>
                    </a>
                    <a href="{{ route('category.list') }}">
                        <li class="p-4 mb-0">
                            CATEGORIAS
                        </li>
                    </a>
                @endif
            </ul>
        </nav>
    </header>

    <!--Sección contenido-->
    <section id='id-contenido'>
        @yield('content')
    </section>

    <!--Botón ir arriba-->
    <section class="d-flex justify-content-end">
        <button class="neonButton irArriba" id="irArriba">
            <img class="mx-auto d-block" width="30px"src="{{ asset('img/flecha.png') }}">
        </button>
    </section>

    <!--Footer-->
    <footer class=" text-center bg-light-color py-5">

        <small class="txt-dark-color">Todos los datos recogidos por la aplicación serán tratados exclusivamente para
            ejecución del proyecto <i>Game&Match</i>, estos no se cederán a terceros ni serán visibles por otros
            usuarios (a excepción del nick). </small><br>
        <small class="txt-dark-color">Las contraseñas se almacenan encriptadas con <a
                href="https://laravel.com/docs/10.x/hashing#introduction" target="_blank" class="txt-dark-color">Bcrypt
                y Argon2</a> , no obstante genera una contraseña <b>exclusiva</b> para esta
            aplicación</small><br><small class="txt-dark-color">Iconos de <a class="txt-dark-color"
                target="_blank"href="https://www.flaticon.es/autores/freepik">Freepik - Flaticon </a></small>

    </footer>

    <!--Enlaces JavaScript-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/1c8e501d4b.js" crossorigin="anonymous"></script>
    <script src="{{ asset('script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    @livewireScripts

</body>

</html>
