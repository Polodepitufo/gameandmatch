<?php

namespace Tests\User;

use App\Livewire\Usertable;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que la ruta es correcta
     * Accediendo como usuario registrado
     */
    public function test_profile_view_can_be_rendered(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        //Simula el acceso a la ruta
        $response = $this
            ->actingAs($user)
            ->get('/profile');
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();
    }

    /**
     * Verifica que a la ruta profile solo acceden usuarios registrados
     * Accediendo sin registrar
     */
    public function test_profile_list_view_cannot_be_rendered_by_not_authenticated_user()
    {

        //Solicita la ruta
        $response = $this->get('/profile');

        //Solicita la ruta y verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);

        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/login');
    }
    /**
     * Verifica que los datos del usuario pueden actualizarse
     */
    public function test_profile_information_can_be_updated(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        //Simula la actualización de los datos
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'nick' => 'Nick Test',
            ]);
        //Verifica que la sesión no tiene errores y nos redirige a la ruta correcta
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');
        //Se refrescan los datos
        $user->refresh();
        //Verifica que los datos se han actualizado correctamente
        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertSame('Nick Test', $user->nick);
        $this->assertNull($user->email_verified_at);
    }

    /**
     * Verifica que el usuario se elimina correctamente
     */
    public function test_user_can_delete_their_account(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();

        //Simula la eliminación del perfil
        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);
        //Verifica que la sesión no tiene errores y que hace la redirección correctamente
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');
        //Verifica que el usuario cerró sesión y que el mensaje de eliminación está en sesión
        $this->assertGuest();
        $this->assertEquals('profile-deleted', session('status'));
    }

    /**
     * Verifica que se introduce la contraseña correcta para eliminar una cuenta
     */
    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        //Simula la eliminación del perfil con una contraseña incorrecta
        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);
        //Verifica que se devuelven errores y que redirige de forma correcta
        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');
        //Verifica que el usuario aún existe
        $this->assertNotNull($user->fresh());
    }

    /**
     * Verifica que un usuario pueda restablecer sus unmatches
     */
    public function test_user_can_reset_unmatches(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();

        //Simula cómo se restablecerían los unmatches
        $response = $this->actingAs($user)->patch('profile/unmatches', [
            'password' => 'password',
        ]);

        //Verifica que la sesión no tiene errores y que redirige con el mensaje correcto
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('profile.edit'))
            ->assertSessionHas('status', 'unmatch');
    }

    /**
     * Verifica que la contraseña puede actualizarse
     */
    public function test_password_can_be_updated(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        //Simula la actualización de la contraseña
        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);
        //Verifica que la sesión no tiener errores y te redirige a la ruta correcta
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');
        //Verifica que la contraseña se ha actualizado correctamente
        $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
    }

    /**
     * Verifica que la contraseña actual que se proporciona para actualizar la contraseña es correcta
     */
    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        //Crea un nuevo usuario
        $user = User::factory()->create();
        //Simula la actualización de la contraseña
        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);
        //Verifica que la sesión no tiener errores y te redirige a la ruta correcta
        $response
            ->assertSessionHasErrorsIn('updatePassword', 'current_password')
            ->assertRedirect('/profile');
    }
}
