<div>
    @foreach ($genres as $genre)
        @if (in_array($genre->id, $array))
            <button class=" txt-dark-color m-1 neonButtonGenre" wire:click="deseleccionar({{ $genre->id }})">
                {{ $genre->name }}
            </button>
        @else
            <button class=" txt-dark-color m-1" wire:click="seleccionar({{ $genre->id }})">
                {{ $genre->name }}
            </button>
        @endif
    @endforeach
    @if (!$array == '')
        @foreach ($games as $game)
            {{ $game->name }}
        @endforeach
    @endif
</div>
