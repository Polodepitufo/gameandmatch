@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')
    <section class="contenido-al-80-movil section">
        <h6 class="neonText-sinflicker text-center">AÑADIDOS RECIENTEMENTE</h6>
    </section>
    <section class="bg-color">
        <div class="contenido-al-80 position-relative">
            @livewire('searchgame')
        </div>
    </section>

@endsection
