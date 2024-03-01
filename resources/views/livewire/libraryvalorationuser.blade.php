<div>
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
                        <th scope="row">{{ $games->name }}</th>

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
