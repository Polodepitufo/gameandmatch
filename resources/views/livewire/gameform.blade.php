<div>

    <form wire:submit="create" novalidate>

        @if (session('status'))
            <section class="d-flex justify-content-end">
                <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2"
                    role="alert">
                    <span class="px-4">{{ session('status') }}</span>
                    <input type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close"
                        wire:click='deleteSession' value="&times;">
                </div>
            </section>
        @endif

        <!-- Name -->
        <div class="sectionHalf">

            <x-input-label for="name" value="* Nombre" class="w-100 mb-2" />
            
            <x-text-input id="namegame" class="block w-full" wire:model="name"  required autofocus  class="w-100" />
  

            @error('name')
                <x-input-error :messages="$errors->get('name')" class="mt-2 w-100" />
            @enderror

        </div>
        <!-- Description-->
        <div class="sectionHalf">

            <x-input-label for="description" :value="__('* Descripción')" class="w-100 mb-2" />
            <textarea wire:model="description" class="w-100" required></textarea>
            @error('description')
                <x-input-error :messages="$errors->get('description')" class="mt-2 w-100" />
            @enderror

        </div>
        <div class="sectionHalf">

            <x-input-label :value="__('Géneros')" class="w-100 mb-2" />
            <select class="form-control js-example-basic-single-2 select-multiple" multiple="" wire:model="genres_">
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="sectionHalf">

            <x-input-label :value="__('Categorias')" class="w-100 mb-2" />
            <select class="form-control " multiple="" wire:model="categories_">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="sectionHalf">

            <x-input-label :value="__('Plataforma')" class="w-100 mb-2" />
            <select class="form-control" wire:model="platform" required>
                    <option value="STEAM" >Steam</option>
                    <option value="SWITCH" selected>Switch</option>
                    <option value="PLAY 4">Play 4</option>
                    <option value="XBOX">Xbox</option>
            </select>
            @error('platform')
                <x-input-error :messages="$errors->get('platform')" class="mt-2 w-100" />
            @enderror
        </div>
        <div class="sectionHalf">
            <button type="submit" class="neonButton w-100 mt-4">
                Crear juego
            </button>

        </div>
    </form>
</div>
