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
            placeholder="Filtrar los juegos" />
    </div>
    <div class=" bg-light-color p-4 border-contenido altura-minima-30">

        <table class="table bg-light-color p-4 0">
            <thead class="">
                <tr>
                    <th scope="col" width="20%">Nombre</th>
                    <th scope="col" width="10%">Puntuación</th>
                    <th scope="col">Valoración</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gamesPuntuar as $games)
                    <tr wire:key="games-{{ $games->id }}">
                        <th scope="row">  <a href="{{ route('library.show', $games->id) }}">{{ $games->name }}</a></th>

                        <th scope="row">

                            {{ number_format($games->puntuation, 1)}}/10.0

                        </th>

                        <th scope="row">{{ $games->valoration }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $gamesPuntuar->links(data: ['scrollTo' => false]) }}

</div>
