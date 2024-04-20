<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskGroupForm extends Form
{
    #[Validate(['required'])]
    public $name = '';

    #[Validate(['required'])]
    public $description = '';

    public function store(): void
    {
        $this->validate();

        auth()->user()->taskGroups()->create($this->toArray());

        $this->reset();
    }
}
