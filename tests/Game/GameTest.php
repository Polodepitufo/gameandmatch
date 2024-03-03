<?php

namespace Tests\Game;

use App\Livewire\Gameform;
use App\Models\Category;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que a la ruta game solo acceden admin y super admin
     * Accediendo como superad
     */
    public function test_game_list_view_can_be_rendered_by_superad()
    {
        //Crea un nuevo usuario con el rol de superad

        $superad = User::factory()->create(['rol' => 'SUPERAD']);

        //Simula el acceso como admin
        $this->actingAs($superad);

        // Se crean datos de prueba
        Genre::factory(3)->create();
        Category::factory(2)->create();

        // Ejecutar el componente Livewire y llama a la función 'render'
        $response = Livewire::test(Gameform::class);

        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();

        // Verifica que las variables correspondientes están disponibles
        $response->assertViewHas('genres');
        $response->assertViewHas('categories');

        // Se obtienen los datos
        $expectedGenres = Genre::orderBy('name', 'ASC')->get();
        $expectedCategories = Category::orderBy('name', 'ASC')->get();

        // Verifica que los datos obtenidos son los datos esperados
        $this->assertEquals($expectedGenres, $response->viewData('genres'));
        $this->assertEquals($expectedCategories, $response->viewData('categories'));
    }

    /**
     * Verifica que a la ruta game solo acceden admin y super admin
     * Accediendo como admin
     */
    public function test_game_list_view_can_be_rendered_by_admin()
    {
        //Crea un nuevo usuario con el rol de superad

        $admin = User::factory()->create(['rol' => 'ADMIN']);

        //Simula el acceso como admin
        $this->actingAs($admin);

        // Se crean datos de prueba
        Genre::factory(3)->create();
        Category::factory(2)->create();

        // Ejecutar el componente Livewire y llama a la función 'render'
        $response = Livewire::test(Gameform::class);

        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();

        // Verifica que las variables correspondientes están disponibles
        $response->assertViewHas('genres');
        $response->assertViewHas('categories');

        // Se obtienen los datos
        $expectedGenres = Genre::orderBy('name', 'ASC')->get();
        $expectedCategories = Category::orderBy('name', 'ASC')->get();

        // Verifica que los datos obtenidos son los datos esperados
        $this->assertEquals($expectedGenres, $response->viewData('genres'));
        $this->assertEquals($expectedCategories, $response->viewData('categories'));
    }

    /**
     * Verifica que a la ruta game solo acceden admin y super admin
     * Accediendo como usuario
     */
    public function test_game_list_view_cannot_be_rendered_by_users()
    {
        //Crea un nuevo usuario con el rol de superad

        $admin = User::factory()->create(['rol' => 'USUARIO']);

        //Simula el acceso como admin
        $this->actingAs($admin);

        //Solicita la ruta
        $response = $this->get('/game');

        //Solicita la ruta y verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);

        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/');
    }

    /**
     * Verifica que a la ruta game solo acceden admin y super admin
     * Accediendo sin registrar
     */
    public function test_game_list_view_cannot_be_rendered_by_not_authenticated_user()
    {

        //Solicita la ruta
        $response = $this->get('/game');

        //Solicita la ruta y verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);

        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/');
    }
}
