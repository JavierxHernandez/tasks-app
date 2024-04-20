<?php

use App\Livewire\TaskTable;
use App\Models\Task;
use App\Models\User;
use Livewire\Livewire;

test('the page loads correctly', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('task.table'));

    $response->assertStatus(200);
});

test('tasks are loaded correctly in the table', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create([
        'user_id' => $user->id,
        'start_date' => now()->format('Y-m-d' . ' 00:00:00'),
        'end_date' => now()->addDays(7)->format('Y-m-d' . ' 00:00:00'),
        'iteration_count' => 7,
        'days' => null,
        'days_of_month' => null,
        'months_of_year' => null,
    ]);

    Livewire::test(TaskTable::class)
        ->assertViewHas('tasks', function ($tasks) use ($task) {
            return $tasks['Tasks Today']->contains('id', $task->id);
        });

});

test('mark as completed function works correctly', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $task = Task::factory()->create(['user_id' => $user->id]);
    Livewire::test('task-table')
        ->call('markAsCompleted', $task->id);

    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'is_completed' => true,
        'iteration_count' => $task->iteration_count - 1,
    ]);
});
