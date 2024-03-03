<?php

namespace Tests\Register;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que la ruta es correcta
     * Accediendo como superad
     */
    public function test_dashboard_view_can_be_rendered_by_superad(): void
    {
        //Crea un usuario con rol superad
        $superadmin = User::factory()->create(['rol' => 'SUPERAD']);

        //Simula el acceso como superad
        $this->actingAs($superadmin);

        //Simula el acceso a la ruta del dashboard
        $response = $this->get('/dashboard');

        // Verifica que la respuesta tiene un código correcto
        $response->assertOk();

        //Verifica que la vista que se carga es la correspondiente para el superadmin
        $response->assertViewIs('dashboard.superad');

        // Verifica que las variables necesarias están disponibles en la vista
        $response->assertViewHasAll(['users', 'games', 'genres', 'categories']);
    }

    /**
     * Verifica que la ruta es correcta
     * Accediendo como admin
     */
    public function test_dashboard_view_can_be_rendered_by_admin(): void
    {
        //Crea un usuario con rol superad
        $superadmin = User::factory()->create(['rol' => 'ADMIN']);

        //Simula el acceso como superad
        $this->actingAs($superadmin);

        //Simula el acceso a la ruta del dashboard
        $response = $this->get('/dashboard');

        // Verifica que la respuesta tiene un código correcto
        $response->assertOk();

        //Verifica que la vista que se carga es la correspondiente para los admin
        $response->assertViewIs('dashboard.admin');

        // Verifica que las variables necesarias están disponibles en la vista
        $response->assertViewHasAll(['users', 'games', 'genres', 'categories']);
    }

    /**
     * Verifica que la ruta es correcta
     * Accediendo como usuario
     */
    public function test_dashboard_view_can_be_rendered_by_users(): void
    {
        //Crea un usuario con rol superad
        $superadmin = User::factory()->create(['rol' => 'USER']);

        //Simula el acceso como superad
        $this->actingAs($superadmin);

        //Simula el acceso a la ruta del dashboard
        $response = $this->get('/dashboard');

        // Verifica que la respuesta tiene un código correcto
        $response->assertOk();

        //Verifica que la vista que se carga es la correspondiente para los usuarios
        $response->assertViewIs('dashboard.usuarios');
    }

    /**
     * Verifica que a la ruta solo pueden acceder usuarios autenticados
     */
    public function test_dashboard_view_cannot_be_rendered_by_not_authenticated_user(): void
    {
        //Simula el acceso a la ruta
        $response = $this->get('/dashboard');

        // Verifica que la respuesta tiene un código de estado 302
        $response->assertStatus(302);

        // Verifica que la redirección es la correcta
        $response->assertRedirect('/login');
    }
}
