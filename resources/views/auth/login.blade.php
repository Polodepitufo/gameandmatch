@extends('layouts.menu_no_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')
    <div class="d-flex columna-flex-direction-reverse">
        <section class="w-50 bg-img-gaming-3 bg-img-gaming  altura-minima-50">
        </section>

        <section class="w-50 columna-flex-direction-formulario">
            <!--Sección cabecera-->
            <section class="text-center section">
                <h6 class="neonText-sinflicker">_GAME&MATCH_</h6>
                <h4>PANEL DE ACCESO</h4>
                <hr>
            </section>

            <!-- Session Status -->
         
            <div class="section row text-break justify-content-center ">
                <!--separacion-->
                <div class="col-lg-6 m-0">
                    <div class="border-contenido row p-4">
                        <div>
                            <form method="POST" action="{{ route('login') }}" novalidate>
                                @csrf

                                <!-- Email Address -->
                                <div class="sectionHalf">

                                    <x-input-label for="email" :value="__('Email')" class="w-100 mb-2" />

                                    <x-text-input id="email" class="block w-full" type="email" name="email"
                                        :value="old('email')" required autofocus autocomplete="username" class="w-100" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 w-100" />

                                </div>

                                <!-- Password -->
                                <div class="sectionHalf">
                                    <x-input-label for="password" :value="__('Contraseña')" class="w-100 mb-2" />

                                    <x-text-input id="password" class="block w-full" type="password" name="password"
                                        required autocomplete="current-password" class="w-100" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2 w-100" />
                                    </p>
                                </div>

                                <div class="sectionHalf">

                                    <button class="neonButton w-100 mt-4">
                                        {{ __('Acceder') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
