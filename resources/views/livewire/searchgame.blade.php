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
    <div class="py-4">
        <x-text-input wire:model="search" class="block w-100" type="text" required
            placeholder="Haz match justo con el juego que buscas." value='' />
    </div>
    @if ($search == ''|| $games=='[]')
        <section class="text-center d-flex columna-flex-direction justify-content-center" >

            <section class=" altura-minima-50 ancho-dashboard ">

            </section>
        </section>
    @else
        @foreach ($games as $index => $game)
            <section class="text-center d-flex columna-flex-direction justify-content-center">

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
                                <span class="button-pill button-pill-line txt-dark-color m-1">
                                    {{ $g->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </section>

            </section>
        @endforeach
    @endif
</div>
