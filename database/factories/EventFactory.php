<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = new \DateTime($this->faker->date());
        $endDate = (clone $startDate)->modify('+1 month');
        
        $startTime = new \DateTime($this->faker->time());
        $endTime = (clone $startTime)->modify('+3 hours');
        
        return [
            'name' => $this->faker->sentence(3),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $this->faker->dateTimeBetween($startTime, $endTime)->format('H:i:s'),
            'venue' => $this->faker->company,
            'address' => $this->faker->address,
        ];

    }
}
