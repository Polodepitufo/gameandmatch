@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')
    <section class="text-center section">
        <h6 class="neonText-sinflicker">BIBLIOTECA DE {{ strtoupper($user->nick) }}</h6> <a
            class=" neonTextHover"href="{{ url()->previous() }}">↩ VOLVER</a>
    </section>
    @livewire('librarytableuser',['user' => $user, key($user->id)])
    <section class="text-center section">
        <h6 class="neonText-sinflicker">TABLA DE PUNTUACIONES</h6>
    </section>
    <section class="bg-color">
        <div class="contenido-al-80">
            @livewire('libraryvalorationuser',['user' => $user, key($user->id)])
        </div>
    </section>
@endsection
