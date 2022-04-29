<?php

namespace Tests\Feature\Ideas;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Category;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    public function test_ideas_shows_correctly_on_main_page()
    {
        $User = User::factory()->create([
            'name' => 'Yoshikage Kira',
            'email' => 'yoshikagekira@cameos.com',
            'email_verified_at' => now()
        ]);

        $CategoryOne = Category::factory()->create([
            'name' => 'Vida Tranquila'
        ]);
        $CategoryTwo = Category::factory()->create([
            'name' => 'Filosofia'
        ]);

        $IdeaOne = Idea::factory()->create([
            'title' => 'Meu nome é Yoshikage Kira',
            'description' => 'Meu nome é Yoshikage Kira. Tenho 33 anos. Minha casa fica na parte nordeste de Morioh.',
            'category_id' => $CategoryOne->id,
            'user_id' => $User->id
        ]);
        $IdeaTwo = Idea::factory()->create([
            'title' => 'Sou imbatível',
            'description' => 'Eu cuido para não me incomodar com inimigos, como ganhar e perder, isso me faria perder o sono à noite.',
            'category_id' => $CategoryTwo->id,
            'user_id' => $User->id
        ]);

        $response = $this->get('/');
        $response->assertSuccessful();
        $response->assertSee($IdeaOne->title);
        $response->assertSee($IdeaOne->description);
        $response->assertSee($IdeaTwo->title);
        $response->assertSee($IdeaTwo->description);
        $response->assertSee($CategoryOne->name);
        $response->assertSee($CategoryTwo->name);
        $response->assertSee($User->name);
    }

    public function test_ideas_shows_correctly_on_single_page()
    {
        $User = User::factory()->create([
            'name' => 'Yoshikage Kira',
            'email' => 'yoshikagekira@cameos.com',
            'email_verified_at' => now()
        ]);

        $CategoryOne = Category::factory()->create([
            'name' => 'Vida Tranquila'
        ]);

        $IdeaOne = Idea::factory()->create([
            'title' => 'Meu nome é Yoshikage Kira',
            'description' => 'Meu nome é Yoshikage Kira. Tenho 33 anos. Minha casa fica na parte nordeste de Morioh.',
            'category_id' => $CategoryOne->id,
            'user_id' => $User->id
        ]);

        $response = $this->get('/ideas/'.$IdeaOne->slug);

        $response->assertSuccessful();
        $response->assertSee($IdeaOne->title);
        $response->assertSee($IdeaOne->description);
        $response->assertSee($CategoryOne->name);
        $response->assertSee($User->name);
    }

    public function test_idea_pagination_shows_correctly()
    {
        Category::factory(5)->create();
        User::factory(10)->create();
        $Ideas = Idea::factory(Idea::IDEAS_PER_PAGE * 2)->create();
        $response = $this->get(route('idea.index'));

        $counter = 1;
        foreach ($Ideas->all() as $idea) {
            if ($counter > Idea::IDEAS_PER_PAGE) {
                $response->assertDontSee($idea->title);

            } else {
                $response->assertSee($idea->title);
            }

            $counter++;
        }

        $response = $this->get(route('idea.index', ['page' => 2]));
        $counter = 1;
        foreach ($Ideas->all() as $idea) {
            if ($counter > Idea::IDEAS_PER_PAGE) {
                $response->assertSee($idea->title);

            } else {
                $response->assertDontSee($idea->title);
            }

            $counter++;
        }
    }

    public function test_ideas_with_same_titles_created_with_different_slugs()
    {
        Category::factory(5)->create();
        User::factory(10)->create();

        $IdeaOne = Idea::factory()->create([
            'title' => 'Metamorfose de Franz Kafka',
            'description' => 'Metamorfose de Franz Kafka',
        ]);

        $IdeaTwo = Idea::factory()->create([
            'title' => 'Metamorfose de Franz Kafka',
            'description' => 'Outra Metamorfose de Franz Kafka',
        ]);

        $this->assertTrue($IdeaOne->slug != $IdeaTwo->slug);

        $response = $this->get(route('idea.show', $IdeaOne->slug));
        $response->assertStatus(200);
        $this->assertTrue(request()->path() === 'ideas/metamorfose-de-franz-kafka');

        $response = $this->get(route('idea.show', $IdeaTwo->slug));
        $response->assertStatus(200);
        $this->assertTrue(request()->path() === 'ideas/metamorfose-de-franz-kafka-2');
    }
}
