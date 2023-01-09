<?php

namespace Database\Factories;

use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserCredentialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public $global_user_id = 1;

    public function definition()
    {
        $user_types = array('admin', 'customer', 'owner');
        $user_type = $this->faker->randomElement($user_types);

        return [
            'username' => $this->faker->unique()->userName(),
            'password' => hash('sha256', '123'),
            'user_type' => $user_type,
            'user_id' => $this->global_user_id++
        ];
    }
}
