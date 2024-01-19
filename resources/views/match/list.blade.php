@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')
<section class="bg-color" >
    <div class="contenido-al-80">

        @livewire('searchgame')
    </div>
</section>
@endsection
