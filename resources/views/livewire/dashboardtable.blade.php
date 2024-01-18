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
    @foreach ($games as $index => $game)
        @if ($index == 0 || $index == 4 || $index === 8 || $index === 12 || $index == 16)
            <section class="text-center d-flex columna-flex-direction">
        @endif
        <section class=" altura-minima-50 ancho-dashboard "
            style=" background: linear-gradient(to bottom, rgba(17, 17, 17, 0.3), rgba(17, 17, 17, 1)), url(background/{{ $game->background }}); background-repeat: no-repeat; background-size: cover; background-position: center;">
            <div class="p-5 d-flex flex-column  altura-100">
                <div class="margin-left-auto flex-start  altura-100 flex-end">
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
                        <span class="button-pill button-pill-line txt-dark-color m-1"> {{ $g->name }}</span>
                    @endforeach
                </div>
            </div>
        </section>
        @if ($index == 3 || $index === 7 || $index === 11 || $index === 15)
            </section>
        @endif
    @endforeach
    </section>

</div>
