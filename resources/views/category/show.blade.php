@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')

    @if (session('status'))
        <section class="d-flex justify-content-end">
            <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2" role="alert">
                <span class="px-4">{{ session('status') }}</span>
                <input type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close" wire:click='deleteSession'
                    value="&times;">
            </div>
        </section>
    @endif

    <div class="d-flex columna-flex-direction-reverse">
        <section class="w-50 bg-img-gaming-2 bg-img-gaming altura-minima-50">
        </section>

        <section class="w-50 columna-flex-direction-formulario">
            <section class="text-center section">
                <h6 class="neonText-sinflicker">EDITAR CATEGORÍA</h6>
            </section>

            <div class="section row text-break justify-content-center ">

                <div class="col-lg-6 m-0">
                    <div class="border-contenido row p-4">
                        @livewire('categoryedit', ['category' => $category, key($category->id)])
                    </div>
                    <div class="row p-4">
                        <a class=" neonTextHover"href="{{ url()->previous() }}#categorylist">↩ VOLVER</a>
                    </div>
                </div>

            </div>
        </section>
    </div>

@endsection
