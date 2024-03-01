<div>
    <section class="text-center section">
        <h6 class="neonText-sinflicker">MATCHES</h6>
    </section>
    <section>
        <section class="section-abajo">
            @if ($gamesmatched->isEmpty())
                <p class="text-center">Sin videojuegos con matches.</p>
            @else
                <section class="text-center d-flex columna-flex-direction">
                    @foreach ($gamesmatched as $index => $gamematch)
                        <section class=" altura-minima-50  ancho-dashboard "
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(../background/{{ $gamematch->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="p-5 d-flex flex-column  altura-100">
                                <div class="margin-left-auto flex-start  altura-100 flex-end">
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
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(../background/{{ $gameenjuego->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
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
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(../background/{{ $gameenpausa->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="p-5 d-flex flex-column  altura-100">

                                <div class="margin-left-auto flex-start  altura-100 flex-end">
                        
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
                            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(../background/{{ $gamecompletado->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                            <div class="p-5 d-flex flex-column  altura-100">

                                <div class="margin-left-auto flex-start  altura-100 flex-end">
                               
                                  
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
    
    <div class="d-flex columna-flex-direction-reverse  align-items-center">

        <section class="w-50 bg-img-gaming-11 bg-img-gaming altura-minima-80">
        </section>
    
        <section class="w-50 columna-flex-direction-formulario align-items-center ">
    
            <div class="section row justify-content-center d-flex columna-flex-direction contenido-al-80 ">
    
                <section class="w-50">
                    <h6 class="neonText-sinflicker">UNMATCHES</h6>
                    <p>{{ $unmatches }}</p>
                    <h6 class="neonText-sinflicker">MATCHES</h6>
                    <p>{{ $matches }}</p>
                </section>
    
                <section class="w-50">
                    <h6 class="neonText-sinflicker">COMPLETADOS</h6>
                    <p>{{ $completados }}</p>
                    <h6 class="neonText-sinflicker">ABANDONADOS</h6>
                    <p>{{ $abandonados }}</p>
                </section>
    
            </div>
    </div>
</div>
