<?php

namespace Tests\Session;

use App\Livewire\Gameedit;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SessionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que la sesión se elimine
     * Esta función se emplea en varios componentes para el test se usa el componente Gameedit
     */
    public function test_delete_session(): void
    {
        // Simula una sesión con valores guardados
        session(['status' => 'some_value']);

        // Ejecuta el componente Livewire y llama a la función 'deleteSession'
        Livewire::test(Gameedit::class)
            ->call('deleteSession');

        // Verifica que la sesión se eliminó correctamente
        $this->assertNull(session('status'));
    }
}
