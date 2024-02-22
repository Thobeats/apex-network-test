<?php

namespace Tests\Feature;

use App\Models\User;
use App\Trait\TestHeaders;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;

class AuthenticationTest extends TestCase
{
    /**
     * A feature test for the registration feature
     */

     public function test_register()
     {
        $array = [
            "name" => "test",
            "email" => fake()->email(),
            "password" => "123Password",
            "role" => random_int(1,2)
        ];
        $response = $this->json('post','/api/register', $array);
        $response->assertStatus(200)->assertJsonStructure([
            "status",
            "message",
            "code",
            "data"
        ]);
     }

    /**
     * A feature test for the login feature for user
     */

     public function test_user_login()
     {
        $email = User::where('role', 2)->select('email')->first()->email;
        $array = [
            "email" => $email,
            "password" => "123Password"
        ];
        $response = $this->json('post','/api/login', $array);
        $response->assertStatus(200)->assertJsonStructure([
            "status",
            "message",
            "code",
            "data"
        ]);
     }

    /**
     * A feature test for the login feature for admin
     */

     public function test_admin_login()
     {
        $email = User::where('role', 1)->select('email')->first()->email;
        $array = [
            "email" => $email,
            "password" => "123Password"
        ];
        $response = $this->json('post','/api/login', $array);
        $response->assertStatus(200)->assertJsonStructure([
            "status",
            "message",
            "code",
            "data"
        ]);
     }
}
