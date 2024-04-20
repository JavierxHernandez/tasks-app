<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskGroupForm;
use Livewire\Component;

class TaskGroupCreate extends Component
{
    public TaskGroupForm $form;

    public function save()
    {
        $this->form->store();
        $this->dispatch('taskGroupCreated');

        session()->flash('success', 'Task group created successfully.');
    }

    public function render()
    {
        return view('livewire.task.task-group-create');
    }
}
