<?php

namespace Tests\User;

use App\Livewire\Usertable;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Verifica que a la ruta user solo accede el superad
     * Accediendo como superad
     */
    public function test_user_list_view_can_be_rendered_by_superad(): void
    {
        //Crea un nuevo usuario con el rol de superad
        $superadmin = User::factory()->create(['rol' => 'SUPERAD']);
        //Simula el acceso como superad
        $this->actingAs($superadmin);
        //Solicita la ruta
        $response = $this->get('/user');
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertStatus(200);
    }

    /**
     * Verifica que a la ruta user solo accede el superad
     * Accediendo como admin
     */
    public function test_user_list_view_cannot_be_rendered_by_admin(): void
    {
        //Crea un nuevo usuario con el rol de usuario
        $user = User::factory()->create(['rol' => 'ADMIN']);

        //Simula el acceso como usuario
        $this->actingAs($user);
        //Solicita la ruta
        $response = $this->get('/user');

        //Solicita la ruta y verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);

        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/');
    }

    /**
     * Verifica que a la ruta user solo accede el superad
     * Accediendo como usuario
     */
    public function test_user_list_view_cannot_be_rendered_by_users(): void
    {
        //Crea un nuevo usuario con el rol de usuario
        $user = User::factory()->create(['rol' => 'USUARIO']);

        //Simula el acceso como usuario
        $this->actingAs($user);
        //Solicita la ruta
        $response = $this->get('/user');

        //Solicita la ruta y verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);

        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/');
    }

    /**
     * Verifica que a la ruta user solo accede el superad
     * Accediendo sin registrar
     */
    public function test_user_list_view_cannot_be_rendered_by_not_authenticated_user(): void
    {

        //Solicita la ruta
        $response = $this->get('/user');

        //Solicita la ruta y verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);

        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/');
    }

    /**
     * Verifica que el superadmin puede cambiar el rol de los usuarios
     */
    public function test_superad_can_toggle_user_role()
    {
        //Crea un nuevo usuario
        $user = User::factory()->create(['rol' => 'ADMIN']);

        //Simula que se ha autenticado
        $this->actingAs($user);

        // Ejecuta el componente Livewire y llama a la función 'rol' con el ID del usuario
        Livewire::test(Usertable::class)
            ->call('rol', $user->id);

        // Verifica que el rol del usuario ha cambiado correctamente
        $this->assertEquals('USUARIO', $user->fresh()->rol);
        // Verifica que el mensaje se guarda en sesión correctamente
        $this->assertEquals(session('status'), 'Rol editado correctamente.');
    }
}
