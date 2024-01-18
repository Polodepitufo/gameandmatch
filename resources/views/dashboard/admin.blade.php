@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')
@section('content')

    <div class="d-flex columna-flex-direction-reverse  align-items-center">

        <section class="w-50 bg-img-gaming-11 bg-img-gaming altura-minima-80">
        </section>

        <section class="w-50 columna-flex-direction-formulario align-items-center">

            <div class="section row justify-content-center d-flex columna-flex-direction contenido-al-80 ">

                <section class="w-50">
                    <h6 class="neonText-sinflicker">JUEGOS</h6>
                    <p>{{ $games }}
                    </p>
                    <h6 class="neonText-sinflicker">USUARIOS</h6>
                    <p>{{ $users }}</p>
                    </p>
                </section>

                <section class="w-50">
                    <h6 class="neonText-sinflicker">CATEGORIAS</h6>
                    <p>{{ $categories }}
                    </p>
                    <h6 class="neonText-sinflicker">GÉNEROS</h6>
                    <p>{{ $genres }}
                    </p>
                </section>

            </div>
    </div>
    </section>

    </div>
@endsection
