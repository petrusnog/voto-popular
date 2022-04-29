<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class GravatarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_generate_default_gravatar_when_no_email_found()
    {
        $User = User::factory()->create([
            'name' => "John Doe",
            'email' => "fake@email.com",
            'email_verified_at' => now()
        ]);

        $this->assertEquals(
            'http://gravatar.com/avatar/'.md5($User->email).'?s=200&d=monsterid',
            $User->getAvatar()
        );

        $image_http_response = Http::get($User->getAvatar());
        $this->assertTrue($image_http_response->successful());
        $this->assertEquals('image/png', $image_http_response->header('content-type'));   
    }
}
