<?php

namespace Tests\Game;

use App\Livewire\Gameedit;
use App\Livewire\Gameform;
use App\Livewire\Gametable;
use App\Models\Category;

use Illuminate\Support\Facades\DB;
use App\Models\Game;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        //Simula el acceso a la ruta
        $response = $this->get('/game');
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();
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
        //Simula el acceso a la ruta
        $response = $this->get('/game');
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();
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

        //Verifica que la respuesta tiene el error esperado
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

        //Verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);

        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/');
    }

    /**
     * Verifica que a la ruta game/id solo acceden admin y super admin
     * Accediendo como superad
     * Accediendo a una ruta con un id que existe
     */
    public function test_game_show_view_can_be_rendered_by_superad()
    {
        //Crea un nuevo usuario con el rol de superad
        $superad = User::factory()->create(['rol' => 'SUPERAD']);
        //Simula el acceso como admin
        $this->actingAs($superad);
        // Crea un juego de prueba
        $game = Game::factory()->create();
        //Simula el acceso a la ruta correcta
        $response = $this->get("/game/{$game->id}");
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();
    }

    /**
     * Verifica que a la ruta game/id solo acceden admin y super admin
     * Accediendo como admin
     * Accediendo a una ruta con un id que existe
     */
    public function test_game_show_view_can_be_rendered_by_admin()
    {
        //Crea un nuevo usuario con el rol de superad
        $admin = User::factory()->create(['rol' => 'ADMIN']);
        //Simula el acceso como admin
        $this->actingAs($admin);
        // Crea un juego de prueba
        $game = Game::factory()->create();
        //Simula el acceso a la ruta correcta
        $response = $this->get("/game/{$game->id}");
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();
    }

    /**
     * Verifica que a la ruta  game/id solo acceden admin y super admin
     * Accediendo como usuario
     */
    public function test_game_show_view_cannot_be_rendered_by_users()
    {
        //Crea un nuevo usuario con el rol de superad
        $admin = User::factory()->create(['rol' => 'USUARIO']);
        //Simula el acceso como admin
        $this->actingAs($admin);
        // Crea un juego de prueba
        $game = Game::factory()->create();
        //Simula el acceso a la ruta correcta
        $response = $this->get("/game/{$game->id}");
        //Verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);
        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/');
    }

    /**
     * Verifica que a la ruta  game/id solo acceden admin y super admin
     * Accediendo sin registrar
     */
    public function test_game_show_view_cannot_be_rendered_by_not_authenticated_user()
    {
        //Crea un juego de prueba
        $game = Game::factory()->create();
        //Simula el acceso a la ruta correcta
        $response = $this->get("/game/{$game->id}");
        //Verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);
        //Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/');
    }

    /**
     * Verifica que si accedes con admin y super admin a la ruta game/id y la ruta no existe, te redirige correctamente a la ruta game
     * Accediendo como superad
     */
    public function test_incorrect_id_game_show_view_is_redirect_by_superad()
    {
        //Crea un nuevo usuario con el rol de superad
        $superad = User::factory()->create(['rol' => 'SUPERAD']);
        //Simula el acceso como admin
        $this->actingAs($superad);
        //Simula el acceso a una ruta incorrecta
        $response = $this->get("/game/678");
        //Verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);
        //Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/game');
    }

    /**
     * Verifica que si accedes con admin y super admin a la ruta game/id y la ruta no existe, te redirige correctamente a la ruta game
     * Accediendo como admin
     */
    public function test_incorrect_id_game_show_view_is_redirect_by_admin()
    {
        //Crea un nuevo usuario con el rol de superad
        $admin = User::factory()->create(['rol' => 'ADMIN']);
        //Simula el acceso como admin
        $this->actingAs($admin);
        //Simula el acceso a una ruta incorrecta
        $response = $this->get("/game/678");
        //Verifica que la respuesta tiene el error esperado
        $response->assertStatus(302);
        // Verifica que la redirección es hacia la ruta correcta
        $response->assertRedirect('/game');
    }

    /**
     * Verifica que la función render en la vista game en el bloque de formulario funciona correctamente
     */
    public function test_game_list_view_form_can_render()
    {
        //Se crean datos de prueba
        Genre::factory(3)->create();
        Category::factory(2)->create();

        //Ejecuta el componente Livewire y llama a la función 'render'
        $response = Livewire::test(Gameform::class);

        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();

        //Verifica que las variables correspondientes están disponibles
        $response->assertViewHas('genres');
        $response->assertViewHas('categories');

        //Se obtienen los datos
        $expectedGenres = Genre::orderBy('name', 'ASC')->get();
        $expectedCategories = Category::orderBy('name', 'ASC')->get();

        //Verifica que los datos obtenidos son los datos esperados
        $this->assertEquals($expectedGenres, $response->viewData('genres'));
        $this->assertEquals($expectedCategories, $response->viewData('categories'));
    }

    /**
     * Verifica que la función render en la vista game en el bloque de tabla funciona correctamente sin realizar una búsqueda
     */
    public function test_game_list_view_table_can_render_with_no_search()
    {
        //Ejecuta el componente Livewire y llama a la función 'render'
        $response = Livewire::test(Gametable::class);
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();
        //Verifica que las variables correspondientes están disponibles
        $response->assertViewHas('games');
    }

    /**
     * Verifica que la función render en la vista game en el bloque de tabla funciona correctamente cuando realizamos una búsqueda
     */
    public function test_game_list_view_table_can_render_with_search()
    {
        //Ejecuta el componente Livewire y llama a la función 'render' con un valor de búsqueda
        $response = Livewire::test(Gametable::class)->set('search', 'SomeSearchTerm')->assertDispatched('search');
        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();
        //Verifica que las variables correspondientes están disponibles
        $response->assertViewHas('games');
    }

    /**
     * Verifica que la función render en la vista game/id funciona correctamente
     */
    public function test_game_show_view_can_render()
    {
        //Se crean datos de prueba
        Genre::factory(3)->create();
        Category::factory(2)->create();

        //Ejecuta el componente Livewire y llama a la función 'render'
        $response = Livewire::test(Gameedit::class);

        //Verifica que la ruta tiene un código de estado correcto
        $response->assertOk();

        //Verifica que las variables correspondientes están disponibles
        $response->assertViewHas('genres');
        $response->assertViewHas('categories');

        //Se obtienen los datos
        $expectedGenres = Genre::orderBy('name', 'ASC')->get();
        $expectedCategories = Category::orderBy('name', 'ASC')->get();

        //Verifica que los datos obtenidos son los datos esperados
        $this->assertEquals($expectedGenres, $response->viewData('genres'));
        $this->assertEquals($expectedCategories, $response->viewData('categories'));
    }

    /**
     * Verifica que la función delete en la vista game funciona correctamente
     */
    public function test_game_list_view_table_can_delete()
    {
        //Simula la creación de un juego
        $game = Game::factory()->create();
        //Contamos los juegos creados
        $this->assertEquals(1, Game::count());
        // Ejecuta el componente Livewire y llama a la función 'delete' con el ID del juego creado
        Livewire::test(Gametable::class)->call('delete', $game->id)->assertSee('Juego eliminado correctamente.',);
        //Volvemos a contarlos para comprobar que el juego se ha eliminado
        $this->assertEquals(0, Game::count());
    }

    /**
     * Verifica que la función delete en la vista game en caso de error muestra el mensaje correctamente
     */
    public function test_game_list_view_cannot_delete_case()
    {
        //Simula la creación de un juego y la vinculación con un usuario
        $game = Game::factory()->create();
        $user = User::factory()->create();
        DB::table('user_game')->insert([
            'id_game' => $game->id,
            'id_user' => $user->id,
            'match' => 'SI',
            'state' => 'MATCHED',
        ]);

        //Contamos los juegos creados
        $this->assertEquals(1, Game::count());
        // Ejecuta el componente Livewire y llama a la función 'delete' con el ID del juego creado
        Livewire::test(Gametable::class)->call('delete', $game->id)->assertSee('No puedes eliminar una juego que ya ha sido vinculado.',);
        //Volvemos a contarlos para comprobar que el juego no se ha eliminado
        $this->assertEquals(1, Game::count());
    }

    /**
     * Verifica que la función create en la vista game funciona correctamente
     */
    public function test_game_list_view_create_with_valid_data()
    {
        // Simula los datos de entrada
        $gameData = [
            'name' => 'Nuevo Juego',
            'background' => 'nuevo-juego.png',
            'description' => 'Descripción del nuevo juego',
            'platform' => 'STEAM',
        ];

        // Ejecuta el componente Livewire y llama a la función create
        Livewire::test(GameForm::class)
            ->set('name', $gameData['name'])
            ->set('background', $gameData['background'])
            ->set('description', $gameData['description'])
            ->set('platform', $gameData['platform'])
            ->call('create');

        // Verifica que el juego se haya creado en la base de datos
        $this->assertDatabaseHas('games', [
            'name' => $gameData['name'],
            'background' => $gameData['background'],
            'description' => $gameData['description'],
            'platform' => $gameData['platform'],
        ]);

        // Verifica el mensaje de sesión
        $this->assertEquals('Juego añadido correctamente.', session('status'));
    }

    /**
     * Verifica que la función create en la vista game no funciona con datos incorrectos
     */
    public function test_game_list_view_cannot_create_with_invalid_data()
    {
        // Simula los datos de entrada
        $gameData = [
            'name' => '',
            'background' => '',
            'description' => '',
            'platform' => 'STEAM2',
        ];

        // Ejecuta el componente Livewire y llama a la función create
        Livewire::test(GameForm::class)
            ->set('name', $gameData['name'])
            ->set('background', $gameData['background'])
            ->set('description', $gameData['description'])
            ->set('platform', $gameData['platform'])
            ->call('create');

        // Verifica que el juego se haya creado en la base de datos
        $this->assertDatabaseMissing('games', [
            'name' => $gameData['name'],
            'background' => $gameData['background'],
            'description' => $gameData['description'],
            'platform' => $gameData['platform'],
        ]);
    }

    /**
     * Verifica que la función update en la vista game/id funciona correctamente
     */
    public function test_game_show_view_edit_with_valid_data()
    {
        //Simula la creación de un juego
        $game = Game::factory()->create();
        // Simula los datos de entrada
        $gameUpdate = [
            'id' => $game->id,
            'name' => 'Nuevo nombre'
        ];
        // Ejecuta el componente Livewire y llama a la función update
        Livewire::test(Gameedit::class, ['game' => $game])
            ->set('id', $game['id'])
            ->set('name', $gameUpdate['name'])
            ->call('update');

        // Verifica que el juego se haya actualizado en la base de datos
        $this->assertDatabaseHas('games', [
            'id' => $gameUpdate['id'],
            'name' => $gameUpdate['name'],
        ]);
    }

    /**
     * Verifica que la función update en la vista game/id no funciona con datos incorrectos
     */
    public function test_game_show_view_cannot_edit_with_invalid_data()
    {

        //Simula la creación de 2 un juego
        $gameExample1 = Game::factory()->create(['name' => 'Super Mario 1']);
        $gameExample2 = Game::factory()->create(['name' => 'Super Mario 2']);
        // Simula los datos de entrada
        $game2Update = [
            'id' => $gameExample2->id,
            'name' => 'Super Mario 1'
        ];
        // Ejecuta el componente Livewire y llama a la función update
        Livewire::test(Gameedit::class, ['game' => $gameExample2])
            ->set('id', $gameExample2['id'])
            ->set('name', $game2Update['name'])
            ->call('update');

        // Verifica que el juego no se haya actualizado en la base de datos
        $this->assertDatabaseHas('games', [
            'id' => $gameExample2['id'],
            'name' => $gameExample2['name'],
        ]);
    }
}
