<?php

namespace Database\Factories;

use App\Models\Frequency;
use App\Models\Task;
use App\Models\TaskGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;


    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'is_completed' => $this->faker->boolean(),
            'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_date' => Carbon::now()->addDay()->format('Y-m-d H:i:s'),
            'iteration_count' => $this->faker->numberBetween(1, 10),
            'days' => $this->faker->word(),
            'days_of_month' => $this->faker->randomNumber(),
            'months_of_year' => $this->faker->randomNumber(),
            'user_id' => User::factory(),
            'task_group_id' => TaskGroup::factory(),
            'frequency_id' => Frequency::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
