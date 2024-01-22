@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')


    <section class="contenido-al-80-movil section">
        <h6 class="neonText-sinflicker text-center">¿NO SABES A QUÉ JUGAR?</h6>
    </section>

    <section class="section">
        <div class="contenido-al-80">
            @livewire('matchgame')
        </div>
    </section>


    <section class="contenido-al-80-movil section">
        <h6 class="neonText-sinflicker text-center">BUSCAR JUEGO</h6>
    </section>

    <section class="section">
        <div class="contenido-al-80 position-relative">
            @livewire('searchgame')
        </div>
    </section>

@endsection
