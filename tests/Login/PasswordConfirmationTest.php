<?php

namespace Tests\Login;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica la confirmación de la contraseña
     */
    public function test_password_can_be_confirmed(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        //Simula la confirmación de la contraseña
        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'password',
        ]);
        //Verifica que la respuesta es una redirección exitosa
        $response->assertRedirect();
        //Verifica que la sesión no tiene errores relacionados con la confirmación de contraseña
        $response->assertSessionHasNoErrors();
    }

    /**
     * Verifica que no se puede confirmar la contraseña con una contraseña incorrecta
     */
    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        //Simula la confirmación de la contraseña con una incorrecta
        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);
        //Verifica que la sesión devuelve errores
        $response->assertSessionHasErrors();
    }


}
