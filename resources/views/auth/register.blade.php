@extends('layouts.menu_no_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')

    <div class="d-flex columna-flex-direction-reverse">
        <section class="w-50 bg-img-gaming-1 bg-img-gaming altura-minima-50">
        </section>
        <section class="w-50 columna-flex-direction-formulario">
            <!--Sección cabecera-->
            <section class="text-center section">
                <h6 class="neonText-sinflicker">_GAME&MATCH_</h6>
                <h4>CREAR CUENTA</h4>
                <hr>
            </section>

       
            <div class="section row text-break justify-content-center ">
                <!--separacion-->
                <div class="col-lg-6 m-0">
                    <div class="border-contenido row p-4">
                        <div>
                            <form method="POST" action="{{ route('register') }}" novalidate>
                                @csrf

                                <!-- Name -->
                                <div class="sectionHalf">

                                    <x-input-label for="name" :value="__('* Nombre')" class="w-100 mb-2" />

                                    <x-text-input id="name" class="block w-full" type="name" name="name"
                                        :value="old('name')" required autofocus class="w-100" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 w-100" />

                                </div>

                                <!-- Nick -->
                                <div class="sectionHalf">

                                    <x-input-label for="nick" :value="__('* Nick')" class="w-100 mb-2" />

                                    <x-text-input id="nick" class="block w-full" type="nick" name="nick"
                                        :value="old('nick')" required class="w-100" />
                                    <x-input-error :messages="$errors->get('nick')" class="mt-2 w-100" />

                                </div>

                                <!-- Email -->
                                <div class="sectionHalf">

                                    <x-input-label for="email" :value="__('* Email')" class="w-100 mb-2" />

                                    <x-text-input id="email" class="block w-full" type="email" name="email"
                                        :value="old('email')" required class="w-100" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 w-100" />

                                </div>

                                <!-- Steam_id -->
                                <div class="sectionHalf">
                                    <x-input-label for="steam_id" :value="__('Steam id')" class="w-100 mb-2" />
                                    <x-text-input id="steam_id" class="block w-full" type="steam_id" name="steam_id"
                                        :value="old('steam_id')" class="w-100" />
                                    <x-input-error :messages="$errors->get('steam_id')" class="mt-2 w-100" />
                                </div>

                                <!-- Password -->
                                <div class="sectionHalf">
                                    <x-input-label for="password" :value="__('* Contraseña')" class="w-100 mb-2" />

                                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                        required autocomplete="new-password" class="w-100" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2 w-100" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="sectionHalf">
                                    <x-input-label for="password_confirmation" :value="__('* Confirma la contraseña')" class="w-100 mb-2" />

                                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                        name="password_confirmation" required autocomplete="new-password" class="w-100" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 w-100" />
                                </div>

                                <div class="sectionHalf">
                                    <button class="neonButton w-100 mt-4">
                                        {{ __('Crear cuenta') }}
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
