@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div class="mt-2 ">
  
        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li class="page-item mx-2 d-none">
                            <button dusk="previousPage" type="" class=" w-100 mt-4 deshabilitado" >
                                <img class="mx-auto d-block" width="30px"src="{{ asset('img/sin-flecha.png') }}">
                            </button>
                        </li>
                @else
                    @if(method_exists($paginator,'getCursorName'))
                        <li class="page-item mx-2">
                            <button dusk="previousPage" type="button" class=" neonButton w-100 mt-4" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->previousCursor()->encode() }}" wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"  rel="prev">   <img class="mx-auto d-block" width="30px"src="{{ asset('img/flecha-izquierda.png') }}"></button>
                        </li>
                    @else
                        <li class="page-item mx-2">
                            <button id="pruebaclick" type="button" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="neonButton w-100 mt-4" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"rel="prev">   <img class="mx-auto d-block" width="30px"src="{{ asset('img/flecha-izquierda.png') }}"></button>
                        </li>
                    @endif
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if(method_exists($paginator,'getCursorName'))
                        <li class="page-item mx-2">
                            <button dusk="nextPage" type="button" class="neonButton w-100 mt-4" wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $paginator->nextCursor()->encode() }}" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" rel="next">   <img class="mx-auto d-block" width="30px"src="{{ asset('img/flecha-derecha.png') }}"></button>
                        </li>
                    @else
                        <li class="page-item mx-2">
                            <button type="button" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class=" neonButton w-100 mt-4" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}"  rel="next">   <img class="mx-auto d-block" width="30px"src="{{ asset('img/flecha-derecha.png') }}"></button>
                        </li>
                    @endif
                @else
                <li class="page-item mx-2 d-none">
                            <button dusk="previousPage" type="" class=" w-100 mt-4 deshabilitado">
                                <img class="mx-auto d-block" width="30px"src="{{ asset('img/sin-flecha.png') }}">
                            </button>
                        </li>
                @endif
            </ul>
        </nav>
  
</div>
