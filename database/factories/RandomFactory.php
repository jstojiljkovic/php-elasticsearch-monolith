<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RandomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company' => $this->faker->company,
            'phone_number' => $this->faker->phoneNumber,
            'description' => $this->faker->text(100),
            'type' => $this->faker->creditCardType,
            'iban' => $this->faker->iban,
            'pan' => $this->faker->creditCardNumber,
            'expiration' => $this->faker->creditCardExpirationDateString,
            'cvv' => $this->faker->randomNumber(3),
            'hex_color' => $this->faker->hexColor,
            'country' => $this->faker->country,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'birthday' => $this->faker->date('Y-m-d')
        ];
    }
}
