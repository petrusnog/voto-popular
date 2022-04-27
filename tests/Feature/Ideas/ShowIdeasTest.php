<?php

namespace Tests\Feature\Ideas;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;

    public function test_ideas_shows_correctly_on_main_page()
    {
        User::factory(10)->create();
        $Ideas = Idea::factory(10)->create();
        $response = $this->get(route('idea.index'));
        $response->assertStatus(200);

        foreach ($Ideas->all() as $idea) {
            $response->assertSee($idea->title);
            $response->assertSee($idea->description);
        }
    }

    public function test_ideas_shows_correctly_on_single_page()
    {
        User::factory(10)->create();
        $Ideas = Idea::factory(10)->create();
        
        foreach ($Ideas->all() as $idea) {
            $response = $this->get(route('idea.show', $idea->slug));
            $response->assertStatus(200);
            $response->assertSee($idea->title);
            $response->assertSee($idea->description);
        }
    }

    public function test_idea_pagination_shows_correctly()
    {
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
        User::factory(10)->create();

        $IdeaOne = Idea::factory()->create([
            'user_id' => User::get()->random()->id,
            'title' => 'Metamorfose de Franz Kafka',
            'description' => 'Metamorfose de Franz Kafka',
        ]);

        $IdeaTwo = Idea::factory()->create([
            'user_id' => User::get()->random()->id,
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
