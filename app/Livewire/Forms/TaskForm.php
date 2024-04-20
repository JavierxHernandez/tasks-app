<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    #[Validate(['required', 'string', 'max:50'])]
    public string $name = '';

    #[Validate(['required', 'string', 'nullable', 'max:150'])]
    public string|null $description = null;

    #[Validate(['boolean'])]
    public bool $isCompleted = false;

    #[Validate(['required', 'date'])]
    public string $startDate = '';

    #[Validate(['required', 'date'])]
    public string $endDate = '';

    #[Validate(['required', 'integer'])]
    public int $iterationCount = 0;

    #[Validate(['array'])]
    public $days = [];

    #[Validate(['integer', 'nullable'])]
    public string|null $dayOfMonth = null;

    #[Validate(['integer', 'nullable'])]
    public string|null $monthOfYear = null;

    #[Validate(['integer', 'nullable'])]
    public string|null $taskGroupId = null;

    #[Validate(
        ['required', 'gt:0', 'integer'],
        message: [
            'frequencyId.required' => 'Please select a frequency.',
            'frequencyId.gt' => 'Please select a frequency.'
        ])]
    public string $frequencyId = '';

    public function store()
    {
        $this->validate();

        $this->getTheIteration();

        Task::create([
            'name' => $this->name,
            'description' => $this->description,
            'is_completed' => $this->isCompleted,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'iteration_count' => $this->iterationCount,
            'user_id' => auth()->id(),
            'task_group_id' => $this->taskGroupId ? intval($this->taskGroupId) : null,
            'frequency_id' => intval($this->frequencyId),
            'days' => empty($this->days) ? null : implode(',', $this->days),
            'days_of_month' => $this->dayOfMonth,
            'months_of_year' => $this->monthOfYear,
        ]);
    }

    /**
     * @return void
     */
    public function getTheIteration(): void
    {
        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);

        $this->iterationCount = match (intval($this->frequencyId)) {
            1 => $startDate->diffInDays($endDate) + 1, // Daily
            2 => $startDate->diffInWeeks($endDate) + 1, // Weekly
            3 => $startDate->diffInMonths($endDate) + 1, // Monthly
            4 => $startDate->diffInYears($endDate) + 1, // Yearly
            default => 0,
        };
    }
}
