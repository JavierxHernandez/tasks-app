<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskForm;
use App\Models\Frequency;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskCreate extends Component
{
    public TaskForm $form;
    public $frequencies;
    public $daysOptions = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
    ];
    public $taskGroups;

    public function mount()
    {
        $this->frequencies = Frequency::select(['id', 'description'])->get();
        $this->getTaskGroups();
    }

    public function save()
    {
        $this->form->store();

        $this->form->reset();

        session()->flash('success', 'Task created successfully.');

        $this->redirect(route('task.table'));
    }

    #[On('taskGroupCreated')]
    public function getTaskGroups()
    {
        $this->taskGroups = auth()->user()->taskGroups()->get();
    }

    public function render()
    {
        return view('livewire.task.task-create');
    }
}
