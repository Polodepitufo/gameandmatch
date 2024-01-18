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

            <x-input-label for="name" :value="__('* Nombre')" class="w-100 mb-2" />
            <x-text-input wire:model="name" class="block w-100" type="text" required />
                
            @error('name')
                <x-input-error :messages="$errors->get('name')" class="mt-2 w-100" />
            @enderror

        </div>

        <div class="sectionHalf">
            <button type="submit" class="neonButton w-100 mt-4">
                Editar categoría
            </button>

        </div>
    </form>
</div>
