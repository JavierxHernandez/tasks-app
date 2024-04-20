<?php

use App\Livewire\TaskGroupCreate;
use App\Models\User;
use Livewire\Livewire;

test('livewire task group creation forms are displayed', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get(route('task-group.create'));

    $response
        ->assertSeeLivewire('task-group-create');
});

it('can save a task group', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $taskGroupData = [
        'name' => 'Test Task Group',
        'description' => 'This is a test task group',
    ];

    Livewire::test(TaskGroupCreate::class)
        ->set('form', $taskGroupData)
        ->call('save')
        ->assertHasNoErrors()
        ->assertStatus(200);

    $this->assertDatabaseHas('task_groups', [
        'name' => 'Test Task Group',
        'description' => 'This is a test task group',
    ]);
});
