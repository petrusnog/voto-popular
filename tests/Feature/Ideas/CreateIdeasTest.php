<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Contracts\Auth\Authenticatable;
use Livewire\Livewire;
use App\Http\Livewire\CreateIdea;

use App\Models\User;
use App\Models\Category;

class CreateIdeasTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_ideas_form_not_showing_when_not_logged_in()
    {
        $response = $this->get(route('idea.index'));
        
        $response->assertSuccessful();
        $response->assertSee('Cadastre-se ou realize seu login para criar ideias incríveis, e iniciar uma votação!');
        $response->assertDontSee('Você pode criar uma votação para qualquer coisa, o limite é a sua imaginação!');
    }

    public function test_create_ideas_form_showing_when_logged_in()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('idea.index'));
        
        $response->assertSuccessful();
        $response->assertDontSee('Cadastre-se ou realize seu login para criar ideias incríveis, e iniciar uma votação!');
        $response->assertSee('Você pode criar uma votação para qualquer coisa, o limite é a sua imaginação!');
    }

    public function test_main_page_contains_livewire_component()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('idea.index'))
            ->assertSeeLivewire('create-idea');
    }

    public function test_livewire_form_validation_works()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', '')
            ->set('category_id', '')
            ->set('description', '')
            ->call('createIdea')
            ->assertHasErrors(['title', 'category_id', 'description'])
            ->assertSee('Campo obrigatório');
        
        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'Meu titulo')
            ->set('category_id', '')
            ->set('description', '')
            ->call('createIdea')
            ->assertHasErrors(['category_id', 'description'])
            ->assertSee('Campo obrigatório');
        
        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'Meu título')
            ->set('category_id', '')
            ->set('description', 'Minha descrição')
            ->call('createIdea')
            ->assertHasErrors(['category_id'])
            ->assertSee('Campo obrigatório');
        
        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'Meu título')
            ->set('category_id', 'categoria')
            ->set('description', 'Minha descrição')
            ->call('createIdea')
            ->assertHasErrors(['category_id'])
            ->assertSee('Campo deve ser um número inteiro');
        
        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'Meu')
            ->set('category_id', 1)
            ->set('description', 'Minha descrição')
            ->call('createIdea')
            ->assertHasErrors(['title'])
            ->assertSee('Deve ter no mínimo 6 caracteres');
    }

    public function test_create_idea_works()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create([
            'name' => 'Categoria 1',
        ]);
        $categoryTwo = Category::factory()->create([
            'name' => 'Categoria 2',
        ]);

        Livewire::actingAs($user)
            ->test(CreateIdea::class)
            ->set('title', 'Os irmãos Karamazov')
            ->set('category_id', $categoryOne->id)
            ->set('description', 'Romance de dostoievski')
            ->call('createIdea')
            ->assertRedirect(route('idea.index'));

        $response = $this->actingAs($user)->get(route('idea.index'));
        $response->assertSuccessful();
        $response->assertSee('Os irmãos Karamazov');
        $response->assertSee('Romance de dostoievski');
        $response->assertSee('Categoria 1');

        $this->assertDatabaseHas('ideas', [
            'title' => 'Os irmãos Karamazov',
            'description' => 'Romance de dostoievski',
            'category_id' => $categoryOne->id,
            'user_id' => $user->id,
        ]);
    }
}