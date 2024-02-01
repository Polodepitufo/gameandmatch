@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')
    @livewire('librarytable')
    @livewire('librarystats')   
    <div id="gameList"></div>
    <section class="text-center section">
        <h6 class="neonText-sinflicker">TABLA DE PUNTUACIONES</h6>
    </section>
    <section class="bg-color" >
        <div class="contenido-al-80">
            @livewire('libraryvaloration')
        </div>
    </section>
@endsection
