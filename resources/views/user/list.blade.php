@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')
<section class="text-center section">
    <h6 class="neonText-sinflicker">GESTIÓN DE USUARIOS</h6>
</section>
<section class="bg-color" >
    <div class="contenido-al-80">
        @livewire('usertable')
    </div>
</section>


@endsection
