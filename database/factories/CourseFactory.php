<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'code' => strtoupper($this->faker->unique()->bothify('??###?')),
            'body' => $this->faker->text($maxNbChars = 500),
            // 'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'status' => $this->faker->randomElement($array = array('draft', 'pending_review', 'published', 'archived')),
            'is_free' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
            'published_at' => $this->faker->dateTimeThisDecade($max = 'now', $timezone = null),
            'reviewed_at' => $this->faker->dateTimeThisYear($max = 'now', $timezone = null),
            'extra_data' => $this->faker->randomDigit,
        ];
    }
}
