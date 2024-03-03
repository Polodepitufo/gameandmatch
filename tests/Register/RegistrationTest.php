<?php

namespace Tests\Register;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que la ruta es correcta
     */
    public function test_registration_view_can_be_rendered(): void
    {
        //Solicita la ruta
        $response = $this->get('/register');
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertStatus(200);
    }

    /**
     * Verifica que un nuevo usuario puede registrarse
     */
    public function test_new_users_can_register(): void
    {

        //Crea un nuevo usuario
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'nick' => 'Nick Test',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        //Verifica que el usuario está autenticado después del registro
        $this->assertAuthenticated();
        //Verifica que la respuesta es una redirección a la ruta correcta
        $response->assertRedirect('/dashboard');
    }
}
