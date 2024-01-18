@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')

    <div class="d-flex columna-flex-direction-reverse">
        <section class="w-50 bg-img-gaming-2 bg-img-gaming altura-minima-50">
        </section>

        <section class="w-50 columna-flex-direction-formulario">
            <section class="text-center section">
                <h6 class="neonText-sinflicker">GESTIÓN DE GÉNEROS</h6>
            </section>

            <div class="section row text-break justify-content-center " >

                <div class="col-lg-6 m-0">
                    <div class="border-contenido row p-4">
                        @livewire('genreform')
                    </div>
                </div>
                <div id="genreList"></div>
            </div>
        </section>
    </div>
    
    <section class="bg-color" >
        <div class="contenido-al-80">

            @livewire('genretable')
        </div>
    </section>


@endsection
