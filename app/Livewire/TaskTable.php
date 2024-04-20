<?php

namespace App\Livewire;

use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;

class TaskTable extends Component
{
    public $tasks;

    public function mount()
    {
        $this->loadTasks();
    }

    public function loadTasks(): void
    {
        $this->tasks = [
            'Tasks Today' => $this->getTasksForPeriod(Carbon::today()),
            'Tasks Tomorrow' => $this->getTasksForPeriod(Carbon::tomorrow()),
            'Tasks Next Week' => $this->getTasksForPeriod(Carbon::today()->addWeek()),
            'Tasks in the Near Future' => $this->getTasksForPeriod(Carbon::today()->addMonth()),
            'Tasks in the Future' => $this->getTasksForPeriod(Carbon::today()->addYear()),
        ];
    }

    public function getTasksForPeriod($period)
    {
        return auth()->user()->tasks()->get()->filter(function ($task) use ($period) {

            if ($task->end_date && Carbon::parse($task->end_date)->lessThan(Carbon::today())) {
                return false;
            }

            if ($task->iteration_count <= 0) {
                return false;
            }

            $startDate = Carbon::parse($task->start_date);

            while ($startDate->lessThanOrEqualTo($period)) {
                if ($startDate->isSameDay($period)) {
                    return true;
                }

                switch ($task->frequency_id) {
                    case 1: // Daily
                        $startDate->addDay();
                        break;
                    case 2: // Weekly
                        $startDate->addWeek();
                        if (!in_array($startDate->dayOfWeek, explode(',', $task->days))) {
                            continue 2;
                        }
                        break;
                    case 3: // Monthly
                        $startDate->addMonth();
                        if ($startDate->day != $task->days_of_month) {
                            continue 2;
                        }
                        break;
                    case 4: // Yearly
                        $startDate->addYear();
                        if ($startDate->day != $task->days_of_month || $startDate->month != $task->months_of_year) {
                            continue 2;
                        }
                        break;
                    default:
                        break;
                }
            }

            return false;
        });
    }

    public function markAsCompleted($taskId)
    {
        $task = auth()->user()->tasks()->find($taskId);
        $task->is_completed = true;
        $task->iteration_count--;
        $task->save();

        $this->loadTasks();
    }

    public function render()
    {
        return view('livewire.task.task-table');
    }
}
