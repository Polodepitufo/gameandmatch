<div>

    @if (session('status'))
        <section class="d-flex justify-content-end">
            <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2" role="alert">
                <span class="px-4">{{ session('status') }}</span>
                <input type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close" wire:click='deleteSession'
                    value="&times;">
            </div>
        </section>
    @endif
    <!-- MATCH-->
    <section class="text-center section">
        <h6 class="neonText-sinflicker">MATCHES</h6>
    </section>
    <section>
        <section class="section-abajo">
            @if ($gamesmatched->isEmpty())
                <p class="text-center">Sin viodejuegos con matches.</p>
            @else
                <section class="text-center d-flex columna-flex-direction">
                    @foreach ($gamesmatched as $index => $gamematch)
                        <section class=" altura-minima-50 ancho-dashboard "
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(background/{{ $gamematch->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="p-5 d-flex flex-column  altura-100">
                                <div class="margin-left-auto flex-start  altura-100 flex-end">
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle"
                                            wire:click="abandonar({{ $gamematch->id }})"><span
                                                class="tooltiptext">Abandonar</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/abandonar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle" wire:click="pausar({{ $gamematch->id }})"><span
                                                class="tooltiptext">En pausa</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/pausar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle" wire:click="jugar({{ $gamematch->id }})"><span
                                                class="tooltiptext">En juego</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/jugar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle"
                                            wire:click="completar({{ $gamematch->id }})"><span
                                                class="tooltiptext">Completar</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/completar.png') }}">
                                        </button>
                                    </div>
                                </div>

                                <div class=" flex-end">
                                    <p>{{ $gamematch->name }}</p>
                                    @foreach ($gamematch->genres as $g)
                                        <span class="button-pill button-pill-line txt-dark-color m-1">
                                            {{ $g->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endforeach
                </section>
                <section class="d-flex justify-content-center">{{ $gamesmatched->links(data: ['scrollTo' => false]) }}
                </section>
            @endif
        </section>
    </section>

    <!-- EN JUEGO-->
    <section class="text-center section">
        <h6 class="neonText-sinflicker">EN JUEGO</h6>
    </section>
    <section>
        <section class="section-abajo">
            @if ($gamesenjuegos->isEmpty())
                <p class="text-center">Sin videojuegos en juego.</p>
            @else
                <section class="text-center d-flex columna-flex-direction">
                    @foreach ($gamesenjuegos as $index => $gameenjuego)
                        <section class=" altura-minima-50 ancho-dashboard "
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(background/{{ $gameenjuego->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="p-5 d-flex flex-column  altura-100">

                                <div class="margin-left-auto flex-start  altura-100 flex-end">
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle"
                                            wire:click="abandonar({{ $gameenjuego->id }})"><span
                                                class="tooltiptext">Abandonar</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/abandonar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle" wire:click="pausar({{ $gameenjuego->id }})"><span
                                                class="tooltiptext">En pausa</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/pausar.png') }}">
                                        </button>
                                    </div>
                             
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle"
                                            wire:click="completar({{ $gameenjuego->id }})"><span
                                                class="tooltiptext">Completar</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/completar.png') }}">
                                        </button>
                                    </div>
                                </div>
                                <div class=" flex-end">
                                    <p>{{ $gameenjuego->name }}</p>
                                    @foreach ($gameenjuego->genres as $g)
                                        <span class="button-pill button-pill-line txt-dark-color m-1">
                                            {{ $g->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endforeach
                </section>
                <section class="d-flex justify-content-center">{{ $gamesenjuegos->links(data: ['scrollTo' => false]) }}
                </section>
            @endif
        </section>
    </section>

    <!-- EN PAUSA-->
    <section class="text-center section">
        <h6 class="neonText-sinflicker">EN PAUSA</h6>
    </section>
    <section>
        <section class="section-abajo">
            @if ($gamesenpausas->isEmpty())
                <p class="text-center">Sin videojuegos en pausa.</p>
            @else
                <section class="text-center d-flex columna-flex-direction">
                    @foreach ($gamesenpausas as $index => $gameenpausa)
                        <section class=" altura-minima-50 ancho-dashboard "
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(background/{{ $gameenpausa->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="p-5 d-flex flex-column  altura-100">

                                <div class="margin-left-auto flex-start  altura-100 flex-end">
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle"
                                            wire:click="abandonar({{ $gameenpausa->id }})"><span
                                                class="tooltiptext">Abandonar</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/abandonar.png') }}">
                                        </button>
                                    </div>
                                  
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle" wire:click="jugar({{ $gameenpausa->id }})"><span
                                                class="tooltiptext">En juego</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/jugar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle"
                                            wire:click="completar({{ $gameenpausa->id }})"><span
                                                class="tooltiptext">Completar</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/completar.png') }}">
                                        </button>
                                    </div>
                                </div>
                                <div class=" flex-end">
                                    <p>{{ $gameenpausa->name }}</p>
                                    @foreach ($gameenpausa->genres as $g)
                                        <span class="button-pill button-pill-line txt-dark-color m-1">
                                            {{ $g->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endforeach
                </section>
                <section class="d-flex justify-content-center">
                    {{ $gamesenpausas->links(data: ['scrollTo' => false]) }}
                </section>
            @endif
        </section>
    </section>

    <!-- COMPLETADO-->
    <section class="text-center section">
        <h6 class="neonText-sinflicker">COMPLETADOS</h6>
    </section>
    <section>
        <section class="section-abajo">
            @if ($gamescompletados->isEmpty())
                <p class="text-center">Sin videojuegos completados.</p>
            @else
                <section class="text-center d-flex columna-flex-direction">
                    @foreach ($gamescompletados as $index => $gamecompletado)
                        <section class=" altura-minima-50 ancho-dashboard "
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(background/{{ $gamecompletado->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="p-5 d-flex flex-column  altura-100">

                                <div class="margin-left-auto flex-start  altura-100 flex-end">
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle"
                                            wire:click="abandonar({{ $gamecompletado->id }})"><span
                                                class="tooltiptext">Abandonar</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/abandonar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle" wire:click="pausar({{ $gamecompletado->id }})"><span
                                                class="tooltiptext">En pausa</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/pausar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle" wire:click="jugar({{ $gamecompletado->id }})"><span
                                                class="tooltiptext">En juego</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/jugar.png') }}">
                                        </button>
                                    </div>
                                  
                                </div>

                                <div class=" flex-end">
                                    <p>{{ $gamecompletado->name }}</p>
                                    @foreach ($gamecompletado->genres as $g)
                                        <span class="button-pill button-pill-line txt-dark-color m-1">
                                            {{ $g->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endforeach
                </section>
                <section class="d-flex justify-content-center">
                    {{ $gamescompletados->links(data: ['scrollTo' => false]) }}
                </section>
            @endif
        </section>
    </section>
    
    <!-- ABANDONADO-->
    <section class="text-center section">
        <h6 class="neonText-sinflicker">ABANDONADOS</h6>
    </section>
    <section>
        <section class="section-abajo">
            @if ($gamesabandonados->isEmpty())
                <p class="text-center">Sin videojuegos abandonados.</p>
            @else
                <section class="text-center d-flex columna-flex-direction">
                    @foreach ($gamesabandonados as $index => $gameabandonado)
                        <section class=" altura-minima-50 ancho-dashboard "
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(background/{{ $gameabandonado->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="p-5 d-flex flex-column  altura-100">

                                <div class="margin-left-auto flex-start  altura-100 flex-end">
                                 
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle" wire:click="pausar({{ $gameabandonado->id }})"><span
                                                class="tooltiptext">En pausa</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/pausar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle" wire:click="jugar({{ $gameabandonado->id }})"><span
                                                class="tooltiptext">En juego</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/jugar.png') }}">
                                        </button>
                                    </div>
                                    <div class="tooltip p-0">
                                        <button class="neonButtonCircle"
                                            wire:click="completar({{ $gameabandonado->id }})"><span
                                                class="tooltiptext">Completar</span>
                                            <img class="d-block " width="18px" src="{{ asset('img/completar.png') }}">
                                        </button>
                                    </div>
                                </div>
                                <div class=" flex-end">
                                    <p>{{ $gameabandonado->name }}</p>
                                    @foreach ($gameabandonado->genres as $g)
                                        <span class="button-pill button-pill-line txt-dark-color m-1">
                                            {{ $g->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    @endforeach
                </section>
                <section class="d-flex justify-content-center">
                    {{ $gamesabandonados->links(data: ['scrollTo' => false]) }}
                </section>
            @endif
        </section>
    </section>

</div>
