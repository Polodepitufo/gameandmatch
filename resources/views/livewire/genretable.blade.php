        <div >
            @if (session('status'))
            <section class="d-flex justify-content-end">
                <div class="alert alert-light alert-dismissible fade show mensajeCorrecto txt-dark-color px-2" role="alert">
                    <span class="px-4">{{ session('status') }}</span>
                    <input type="button" class="boton-cerrar" data-dismiss="alert" aria-label="Close" wire:click='deleteSession' value="&times;">
                </div>
            </section>
        @endif
            <div class="py-4">
                <x-text-input wire:model="search" class="block w-100" type="text" required placeholder="Filtrar los géneros"/>
             </div> 
            <div class=" bg-light-color p-4 border-contenido altura-minima-30">
            
                <table class="table bg-light-color p-4 0" >
                    <thead class="">
                        <tr>
                            <th scope="col" width="5%">Id</th>
                            <th scope="col" width="90%">Nombre</th>
                            <th scope="col" width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($genres as $genre)
                            <tr wire:key="genre-{{ $genre->id }}">
                                <th scope="row" width="0">{{ $genre->id }}</th>

                                <th scope="row">
                                    
                                <a href="{{ route('genre.show',$genre->id) }}">{{ $genre->name }}</a>
                                 
                                </th>
                                <th scope="row" width="0">
                                    <button class="m-0 neonButton botonEliminar" wire:click="delete({{ $genre->id }})">
                                        x
                                    </button>
                                </th>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $genres->links(data: ['scrollTo' => false]) }}
          
        </div>
