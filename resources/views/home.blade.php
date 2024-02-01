@extends('layouts.menu_no_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')
    @if (session('status') === 'profile-deleted')
        <section class="d-flex justify-content-end">
            <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2" role="alert">
                <span class="px-4">Perfil eliminado correctamente.</span>
                <button type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close">
                    &times;
                </button>
            </div>
        </section>
    @endif

    <section class="contenido-al-80-movil section">
        <img class="mx-auto d-block bounceImg" width="50px"src="{{ asset('img/icon.png') }}">
        <h6 class="neonText text-center">_GAME&MATCH_</h6>
        <h4 class="text-center">¿A QUÉ TE APETECE JUGAR HOY?</h4>
        <hr>
        <p class="contenido-centrado">La cita perfecta, tú y un nuevo juego al que jugar. <br>Elige tu próximo videojuego,
            comparte tu
            perfil con otros jugadores y sé el primero en enterarte de a qué juegan tus amigos.
        </p>
    </section>

    <section class="row contenido-al-80 justify-content-around section">
        <div class="col-lg-6">
            <h6 class="neonText-sinflicker">SISTEMA DE MATCH</h6>
            <h4>¿CÓMO FUNCIONA EL MATCH?</h4>
            <p>Te mostraremos juegos de forma aleatoria en base a los filtros seleccionados con portada,
                nombre, categoría y género. Tú elegirás si quedarte con esa opción o seguir buscando otra que te guste más.
            </p>
        </div>
        <div class="col-lg-6">
            <h6 class="neonText-sinflicker">COMPARTE TU PERFIL</h6>
            <h4>¿QUÉ Y QUIÉN PUEDE VERLO?</h4>
            <p>Una vez te registres, tu perfil será visible para el resto de usuarios registrados:
                videojuegos en biblioteca, videojuegos ‘en juego’, videojuegos valorados. Pero no te preocupes, tus datos
                personales serán privados.
            </p>
        </div>
    </section>

    <section class="text-center  bg-light-color d-flex columna-flex-direction">
       
            <section class="bg-img-gaming-9 bg-img-gaming  w-25">
            </section>
            <section class="bg-img-gaming-8 bg-img-gaming w-25">
            </section>
            <section class="bg-img-gaming-7 bg-img-gaming altura-minima-50 w-25">
            </section>
            <section class="bg-img-gaming-10 bg-img-gaming  w-25">
            </section>
    </section>

    <section class="text-center section-abajo bg-light-color py-5">
        <h6 class="txt-dark-color contenido-al-80-movil text-center">+ 1360 JUEGOS EN NUESTRA BASE DE DATOS</h6>
    </section>

    <section class="contenido-al-80 justify-content-around section">
        <img class="mx-auto d-block" width="50px" src="{{ asset('img/estrella.png') }}">
        <h6 class="neonText-sinflicker text-center">VALORACIONES</h6>
        <h4 class="text-center">ESTO ES LO QUE NUESTROS USUARIOS OPINAN</h4>
        <hr>
        <div class="row">
            <div class="col-lg-3 col-md-6 misma-altura my-2">
                <div class="border-contenido p-4 d-flex flex-column justify-content-between">
                    <p> Terminé The Binding of Isaac y estaba buscando más roguelikes. Las categorías están de lujo.
                    </p>
                    <p class="">Ladysnowball</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 misma-altura my-2">
                <div class="border-contenido p-4 d-flex flex-column justify-content-between">
                    <p> Me encanta la web, gracias a ella he conocido juegos increíbles. Recomendadísima la experiencia.
                    </p>
                    <p class="">ZuriOtsoa</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 misma-altura my-2">
                <div class="border-contenido p-4 d-flex flex-column justify-content-between">
                    <p>Si no sabes qué jugar, Game and match es muy útil: usando los filtros he encontrado juegos de narrativa guapísimos.
                    </p>
                    <p class="">Icywind</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 misma-altura my-2">
                <div class="border-contenido p-4 d-flex flex-column justify-content-between">
                    <p> Necesitaba un registro de todos los juegos que compro y tengo a medias, ¡Gameandmatch es perfecto para ello!
                    </p>
                    <p class="">Iris</p>
                </div>
            </div>
        </div>
    </section>

@endsection
