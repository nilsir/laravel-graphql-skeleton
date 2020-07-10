<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;
    use MakesGraphQLRequests;

    /**
     * @test
     */
    public function can_create_user()
    {
        $name = $this->faker->word;
        $email = $this->faker->unique()->email;
        $password = 'password';

        $this->graphQL(/* @lang GraphQL */ '
            mutation createUser($name: String!, $email: String!, $password: String!) {
              createUser(name: $name, email: $email, password: $password) {
                name
                email
              }
            }',
            [
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]
        )->assertJson([
            'data' => [
                'createUser' => [
                    'name' => $name,
                    'email' => $email,
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function can_get_users()
    {
        factory(User::class, 13)->create();

        $response = $this->graphQL(/* @lang GraphQL */ '
            query users($first: Int) {
              users(first: $first) {
                data{
                  id
                  name
                  email
                }
              }
            }',
            [
                'first' => 10,
            ]
        );
        $response->assertStatus(200);

        $this->assertJsonResponseContent($response, __DIR__. '/Response/index.json');
    }
}
