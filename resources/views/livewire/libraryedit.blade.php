<div>
    <form wire:submit="update" novalidate>

        @if (session('status'))
        <section class="d-flex justify-content-end">
            <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2" role="alert">
                <span class="px-4">{{ session('status') }}</span>
                <input type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close" wire:click='deleteSession' value="&times;">
            </div>
        </section>
    @endif

        <!-- Name -->
        <div class="sectionHalf">

            <x-input-label for="puntuation" :value="__('* Puntuación')" class="w-100 mb-2" />
            <x-text-input wire:model="puntuation" class="block w-100" type="text" required />
                
            @error('puntuation')
                <x-input-error :messages="$errors->get('puntuation')" class="mt-2 w-100" />
            @enderror

        </div>

        <div class="sectionHalf">

            <x-input-label for="valoration" :value="__('Valoración')" class="w-100 mb-2" />
            <textarea wire:model="valoration" class="w-100" required></textarea>
            @error('valoration')
                <x-input-error :messages="$errors->get('valoration')" class="mt-2 w-100" />
            @enderror

        </div>

        <div class="sectionHalf">
            <button type="submit" class="neonButton w-100 mt-4">
                Editar puntuación y valoración
            </button>

        </div>
    </form>
</div>
