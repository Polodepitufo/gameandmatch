@extends('layouts.menu_registrado')
@section('title', 'GAMEANDMATCH')

@section('content')
    <!--Sección cabecera-->
    @if (session('status') === 'password-updated')
        <section class="d-flex justify-content-end">
            <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2" role="alert">
                <span class="px-4">Contraseña actualizada correctamente.</span>
                <button type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close">
                    &times;
                </button>
            </div>
        </section>
    @endif

    @if (session('status') === 'profile-updated')
        <section class="d-flex justify-content-end">
            <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2" role="alert">
                <span class="px-4">Perfil actualizado correctamente.</span>
                <button type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close">
                    &times;
                </button>
            </div>
        </section>
    @endif

    @if (session('status') === 'profile-delete')
        <section class="d-flex justify-content-end">
            <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2" role="alert">
                <span class="px-4">Se ha producido un error eliminado tu cuenta.</span>
                <button type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close">
                    &times;
                </button>
            </div>
        </section>
    @endif

    <!--Sección generales-->

    <div class="d-flex columna-flex-direction-reverse" id="perfil">
        <section class="w-50 bg-img-gaming-6 bg-img-gaming altura-minima-50">
        </section>
        <section class="w-50 columna-flex-direction-formulario">
            <section class="text-center section">
                <h6 class="neonText-sinflicker">ACTUALIZAR PERFIL</h6>
            </section>
            <div class="section row text-break justify-content-center ">
                <!--separacion-->
                <div class="col-lg-6 m-0">
                    <div class="border-contenido row p-4">
                        <div>
                            <form method="post" action="{{ route('profile.update') }}" novalidate>
                                @csrf
                                @method('patch')
                        
                                <div class="sectionHalf">

                                    <x-input-label for="name" :value="__('Name')" class="w-100 mb-2" />

                                    <x-text-input id="name" class="block w-full" type="text" name="name"
                                        :value="old('name', $user->name)" required autofocus autocomplete="name" class="w-100" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 w-100" />

                                </div>

                                <div class="sectionHalf">

                                    <x-input-label for="nick" :value="__('Nick')" class="w-100 mb-2" />

                                    <x-text-input id="nick" class="block w-full" type="text" name="nick"
                                        :value="old('nick', $user->nick)" required autofocus autocomplete="nick" class="w-100" />
                                    <x-input-error :messages="$errors->get('nick')" class="mt-2 w-100" />

                                </div>

                                <div class="sectionHalf">

                                    <x-input-label for="email" :value="__('Email')" class="w-100 mb-2" />

                                    <x-text-input id="email" class="block w-full" type="email" name="email"
                                        :value="old('email', $user->email)" required autofocus autocomplete="username" class="w-100" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 w-100" />

                                </div>

                                <div class="sectionHalf">
                                    <button class="neonButton w-100 mt-4">
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <div class="d-flex columna-flex-direction" id="contraseña">

        <section class="w-50 columna-flex-direction-formulario">
            <section class="text-center section">
                <h6 class="neonText-sinflicker">ACTUALIZAR CONTRASEÑA</h6>
            </section>
            <div class="section row text-break justify-content-center ">
                <!--separacion-->
                <div class="col-lg-6 m-0">
                    <div class="border-contenido row p-4">
                        <div>
                            <form method="post" action="{{ route('password.update') }}">
                                @csrf
                                @method('put')
                              
                                <div class="sectionHalf">
                                    <x-input-label for="update_password_current_password" :value="__('Contraseña actual')"
                                        class="w-100 mb-2" />
                                    <x-text-input id="update_password_current_password" name="current_password" type="password"
                                        class="w-100" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('current_password')" class="mt-2 w-100" />
                                </div>
                                <div class="sectionHalf">
                                    <x-input-label for="password" :value="__('Nueva contraseña')" class="w-100 mb-2" />
                                    <x-text-input id="password" name="password" type="password"
                                        class="w-100" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 w-100" />
                                </div>
                                <div class="sectionHalf">
                                    <x-input-label for="update_password_password_confirmation" :value="__('Confirmar contraseña')"
                                        class="w-100 mb-2" />
                                    <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                        type="password" class="w-100" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 w-100" />
                                </div>

                                <div class="sectionHalf">
                                    <button class="neonButton w-100 mt-4">
                                        {{ __('Guardar') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-50 bg-img-gaming-5 bg-img-gaming altura-minima-50">
        </section>
    </div>

    <div class="d-flex columna-flex-direction-reverse" id="cuenta">

        <section class="w-50 bg-img-gaming-4 bg-img-gaming altura-minima-50">
        </section>

        <section class="w-50 columna-flex-direction-formulario">
            <section class="text-center section">
                <h6 class="neonText-sinflicker">ELIMINAR CUENTA</h6>
            </section>
            <div class="section row text-break justify-content-center ">
                <!--separacion-->
                <div class="col-lg-6 m-0">
                    <div class="border-contenido row p-4">
                        <div>
                            <form method="post" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('delete')

                                <p>Es legal cansarse de una app. Recuerda que si eliminas tu cuenta se eliminarán todos los
                                    datos relacionados.</p>
                                <div class="sectionHalf">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                                    <x-text-input id="password" name="password" type="password" class="w-100"
                                        placeholder="{{ __('Password') }}" />
                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="sectionHalf">
                                    <button class="neonButton w-100 mt-4" data-token="{{ csrf_token() }}">
                                        {{ __('Eliminar') }}
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
