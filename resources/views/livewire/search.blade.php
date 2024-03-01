<div>


    <section class="contenido-al-80-movil section">
        <h6 class="neonText-sinflicker text-center">BUSCAR USUARIO</h6>
    </section>

    <section class="section">
        <div class="contenido-al-80 position-relative">

            <div class="py-4">
                <x-text-input wire:model="search" class="block w-100" type="text" required
                    placeholder="Filtrar los usuarios." value='' />
            </div>
            @if ($search == '')
                <section class="text-center d-flex columna-flex-direction justify-content-center">

                    <section class=" ancho-dashboard-2 ">
                        <div class="p-5 d-flex flex-column  altura-100 justify-content-center">
                            <p>Filtra para que aquí aparezca el usuario que buscas.</p>
                        </div>
                    </section>
                </section>
            @elseif (count($users) > 0)
                <section class="text-center d-flex columna-flex-direction justify-content-center">
                    <section class="ancho-dashboard-2 ">
                        <div class="p-5 d-flex flex-column  altura-100 justify-content-center">
                            @foreach ($users as $index => $user)
                                <p> <a class="neonTextHover" href="{{ route('search.show', $user->id) }}">{{ strtoupper($user->nick) }}</a></p>
                            @endforeach
                        </div>
                    </section>
                </section>
            @else
                <section class="text-center d-flex columna-flex-direction justify-content-center">
                    <section class="ancho-dashboard-2 ">
                        <div class="p-5 d-flex flex-column  altura-100 justify-content-center">
                            <p>No se han encontrado coincidencias.</p>
                        </div>
                    </section>
                </section>
            @endif

        </div>
    </section>


    <section class="contenido-al-80-movil section">
        <h6 class="neonText-sinflicker text-center">BUSCAR ALMA GEMELA</h6>
    </section>
    <section class="section">
        <div class="contenido-al-80 position-relative">
            @if (count($soulmates) > 0)
                <section class="text-center d-flex columna-flex-direction justify-content-center">
                    <section class="ancho-dashboard-2 ">
                        <div class="p-5 d-flex flex-column  altura-100 justify-content-center">
                            <img class="mx-auto d-block" width="60px"src="{{ asset('img/corazon-match.png') }}">
                            @foreach ($soulmates as $soulmate)
                                <p>Tu alma gemela es </p><p><a class="neonTextHover" href="{{ route('search.show', $soulmate->id_user) }}">{{ strtoupper($soulmate->nick) }}</a>
                                <p> Tenéis en común {{ $soulmate->coincidencias }} juegos.</p>
                            @endforeach
                        </div>
                    </section>
                </section>
            @else
                <section class="text-center d-flex columna-flex-direction justify-content-center">
                    <section class="ancho-dashboard-2 ">
                        <div class="p-5 d-flex flex-column  altura-100 justify-content-center">
                            <img class="mx-auto d-block" width="50px"src="{{ asset('img/corazon-roto.png') }}">
                            <p>Aún no hemos encontrado a tu alma gemela.</p>
                        </div>
                    </section>
                </section>
            @endif
        </div>
    </section>
</div>
