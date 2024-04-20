<?php

use App\Livewire\TaskCreate;
use App\Models\Frequency;
use App\Models\TaskGroup;
use App\Models\User;
use Database\Seeders\FrequenciesTableSeeder;
use Livewire\Livewire;

test('create task page is displayed', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get(route('task.create'));

    $response
        ->assertOk();
});

test('livewire task creation forms are displayed', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get(route('task.create'));

    $response
        ->assertSeeLivewire('task-create');
});

it('can save a task', function () {
    $user = User::factory()->create();

    $this->seed(FrequenciesTableSeeder::class);

    $frequency = Frequency::first();

    $taskGroup = TaskGroup::create([
        'name' => 'Test Group',
        'description' => 'This is a test group',
        'user_id' => $user->id,
    ]);

    $this->actingAs($user);

    $taskData = [
        'name' => 'Test Task',
        'description' => 'This is a test task',
        'startDate' => now()->format('Y-m-d'),
        'endDate' => now()->addDays(7)->format('Y-m-d'),
        'taskGroupId' => $taskGroup->id,
        'frequencyId' => $frequency->id,
    ];

    Livewire::test(TaskCreate::class)
        ->set('form', $taskData)
        ->call('save')
        ->assertHasNoErrors()
        ->assertStatus(200)
        ->assertRedirect(route('task.table'));

    $this->assertDatabaseHas('tasks', [
        'name' => 'Test Task',
        'description' => 'This is a test task',
    ]);
});
