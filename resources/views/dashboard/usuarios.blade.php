@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')
@section('content')
    <section class="contenido-al-80-movil section">
        <h6 class="neonText-sinflicker text-center">AÑADIDOS RECIENTEMENTE</h6>
    </section>
    <section class="section-abajo">
        @livewire('dashboardtable')
    </section>
@endsection
