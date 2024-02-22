<?php

namespace Tests\Feature;

use App\Models\User;
use App\Trait\TestHeaders;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use TestHeaders;
    /**
     * Test the create method in the UserController class
     */
    public function test_unauthenticated_create(): void
    {
        $array = [
            "name" => "test",
            "email" => fake()->email(),
            "password" => "123Password",
            "role" => 1
        ];
        $response = $this->json('post','/api/user/create', $array);
        $response->assertStatus(401);
    }

    public function test_create(): void
    {
        //Authenticate the User
        $email = User::where('role', 2)->select('email')->first()->email;
        $array = [
            "email" => $email,
            "password" => "123Password"
        ];
        $response = $this->json('post','/api/login', $array);
        $token = $response['data']['token'];

        //Set the Headers
        $this->setHeaders($token);
        
        $array = [
            "name" => "test",
            "email" => fake()->email(),
            "password" => "123Password",
            "role" => 1
        ];
        $response = $this->json('post','/api/user/create', $array, $this->getHeaders());
        $response->assertStatus(200)
                ->assertJsonStructure([
                    "status",
                    "message",
                    "code",
                    "data"
                ]);
    }


    /**
     * Test the all method in the UserController class
     */
    public function test_unauthenticated_all(): void
    {
        $response = $this->json('get','/api/user/all');
        $response->assertStatus(401);
    }

    public function test_all(): void
    {
        //Authenticate the User
        $email = User::where('role', 2)->select('email')->first()->email;
        $array = [
            "email" => $email,
            "password" => "123Password"
        ];
        $response = $this->json('post','/api/login', $array);
        $token = $response['data']['token'];

        //Set the Headers
        $this->setHeaders($token);

        $response = $this->json('get','/api/user/all',[], $this->getHeaders());
        $response->assertStatus(200)
                ->assertJsonStructure([
                    "status",
                    "message",
                    "code",
                    "data"
                ]);
    }

    /**
     * Test the get method in the UserController class
     */
    public function test_unauthenticated_get(): void
    {
        $id = User::first()->id;
        $response = $this->json('get',"/api/user/get/$id");
        $response->assertStatus(401);
    }

    public function test_get(): void
    {
        //Authenticate the User
        $email = User::where('role', 2)->select('email')->first()->email;
        $array = [
            "email" => $email,
            "password" => "123Password"
        ];
        $response = $this->json('post','/api/login', $array);
        $token = $response['data']['token'];

        //Set the Headers
        $this->setHeaders($token);

        $id = User::first()->id;
        $response = $this->json('get',"/api/user/get/$id",[], $this->getHeaders());
        $response->assertStatus(200)
        ->assertJsonStructure([
            "status",
            "message",
            "code",
            "data"
        ]);
    }

    /**
     * Test the update method in the UserController class
     */
    public function test_unauthenticated_update(): void
    {
        $id = User::first()->id;
        $array = [
            "name" => "update test",
            "email" => fake()->email(),
            "password" => "123Password",
            "role" => 1
        ];
        $response = $this->json('put',"/api/user/update/$id", $array);
        $response->assertStatus(401);
    }

    public function test_update(): void
    {
        //Authenticate the User
        $email = User::where('role', 2)->select('email')->first()->email;
        $array = [
            "email" => $email,
            "password" => "123Password"
        ];
        $response = $this->json('post','/api/login', $array);
        $token = $response['data']['token'];

        //Set the Headers
        $this->setHeaders($token);

        $id = User::first()->id;
        $array = [
            "name" => "update test",
            "email" => fake()->email(),
            "password" => Hash::make("123Password"),
            "role" => 1
        ];
        $response = $this->json('put',"/api/user/update/$id",$array, $this->getHeaders());
        $response->assertStatus(200)
        ->assertJsonStructure([
            "status",
            "message",
            "code",
            "data"
        ]);
    }

    /**
     * Test the delete method in the UserController class
     */
    public function test_unauthenticated_delete(): void
    {
        $id = User::first()->id;
        $response = $this->json('delete',"/api/user/delete/$id");
        $response->assertStatus(401);
    }

    public function test_delete_by_user(): void
    {
        //Authenticate the User
        $email = User::where('role', 2)->select('email')->first()->email;
        $array = [
            "email" => $email,
            "password" => "123Password"
        ];
        $response = $this->json('post','/api/login', $array);
        $token = $response['data']['token'];

        //Set the Headers
        $this->setHeaders($token);

        $id = User::first()->id;
        $response = $this->json('delete',"/api/user/delete/$id",[], $this->getHeaders());
        $response->assertStatus(403)
        ->assertJsonStructure([]);
    }

    public function test_delete_by_admin(): void
    {
        //Authenticate the User
        $email = User::where('role', 1)->select('email')->first()->email;
        $array = [
            "email" => $email,
            "password" => "123Password"
        ];
        $response = $this->json('post','/api/login', $array);
        $token = $response['data']['token'];

        //Set the Headers
        $this->setHeaders($token);
        $id = User::where('role', 2)->first()->id;
        $response = $this->json('delete',"/api/user/delete/$id",[], $this->getHeaders());
        $response->assertStatus(200)
        ->assertJsonStructure([]);
    }
}
