<?php

namespace Tests\Login;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que la ruta es correcta
     */
    public function test_login_view_can_be_rendered(): void
    {
        //Solicita la ruta
        $response = $this->get('/login');
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();
    }

    /**
     * Verifica que los usuarios pueden autenticarse si introducen datos correctos
     */
    public function test_users_can_authenticate_using_the_login_view(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        // Se intenta autenticar al usuario con una contraseña correcta
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        //Verifica que el usuario se ha autenticado
        $this->assertAuthenticated();
        //Verifica que la respuesta es una redirección a la ruta correcta
        $response->assertRedirect('/dashboard');
    }

    /**
     * Verifica que los usuarios no pueden autenticarse con una contraseña invalida
     */
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        // Se intenta autenticar al usuario con una contraseña incorrecta
        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
        //Verifica que el usuario no se ha autenticado
        $this->assertGuest();
    }

    /**
     * Verifica que los usuarios autenticados puedan cerrar sesión
     */
    public function test_users_can_logout(): void
    {
        //Crea un nuevo usuario 
        $user = User::factory()->create();
        //Simula el cierre de sesión
        $response = $this->actingAs($user)->post('/logout');
        //Verifica que el usuario está desautenticado después del cierre de sesión
        $this->assertGuest();
        //Verifica que la respuesta es una redirección a la ruta correcta
        $response->assertRedirect('/');
    }
}
