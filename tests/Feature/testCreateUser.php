<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;

class testCreateUser extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_normal_user(Faker $faker)
    {
        $firstName = $faker->firstName();
        $email = $faker->email();
        $lastName = $faker->lastName();

        $response = $this->post('/json/user',[
            'first_name'    => $firstName,
            'last_name'     => $lastName,
            'email'         => $email,
            'password'      => $faker->password(),
            'phone'         => $faker->phoneNumber(),
            'birth_date'    => $faker->date('Y-m-d', 'now')
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $firstName,
            'email' => $email,
        ]);

        $user = User::where('email', $email)->first();
        $this->assertNotNull($user);
    }

}
