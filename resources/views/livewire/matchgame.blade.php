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
    <div class="py-4 d-flex flex-wrap">
        @foreach ($genres as $genre)
            @if (in_array($genre->id, $array))
                <small class="m-0"> <button class=" txt-dark-color m-1 neonButtonGenre"
                        wire:click="deseleccionar({{ $genre->id }})">
                        {{ $genre->name }}
                    </button></small>
            @else
                <small class="m-0"> <button class=" txt-dark-color m-1" wire:click="seleccionar({{ $genre->id }})">
                        {{ $genre->name }}
                    </button></small>
            @endif
        @endforeach
    </div>
    @if (!$array == '' && count($games) > 0)
        @foreach ($games as $game)
            <section class="text-center d-flex columna-flex-direction justify-content-center">

                <section class=" altura-minima-50 ancho-dashboard-2 "
                    style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(background/{{ $game->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                    <div class="p-5 d-flex flex-column  altura-100">
                        <div class="altura-100 justify-content-between d-flex">
                            <div class="tooltip p-0">
                                <button class="neonButtonCircle" wire:click="unmatch({{ $game->id }})">
                                    <img class="d-block" width="18px"src="{{ asset('img/abandonar.png') }}">
                                    <span class="tooltiptext">Unmatch</span>
                                </button>
                            </div>
                            <div class="tooltip p-0">
                                <button class="neonButtonCircle" wire:click="match({{ $game->id }})">
                                    <img class="d-block" width="18px"src="{{ asset('img/corazon-add.png') }}">
                                    <span class="tooltiptext">Match</span>
                                </button>
                            </div>
                        </div>

                        <div class=" flex-end">
                            <p>{{ $game->name }}</p>
                            @foreach ($game->genres as $g)
                                <span class="button-pill button-pill-line txt-dark-color m-1">
                                    {{ $g->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </section>
            </section>
        @endforeach
    @elseif(count($games) == 0)
        <section class="text-center d-flex columna-flex-direction justify-content-center">

            <section class=" altura-minima-50 ancho-dashboard-2 ">
                <div class="p-5 d-flex flex-column  altura-100 justify-content-center">
                    Aún no tenemos juegos que coincidan con el filtro establecido.
                </div>
            </section>
        </section>
    @else
        <section class="text-center d-flex columna-flex-direction justify-content-center">

            <section class=" altura-minima-50 ancho-dashboard-2 ">
                <div class="p-5 d-flex flex-column  altura-100 justify-content-center">
                    Filtra para que aquí aparezca tu próximo juego fav.
                </div>
            </section>
        </section>
    @endif
</div>
