<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_completed',
        'start_date',
        'end_date',
        'iteration_count',
        'days',
        'days_of_month',
        'months_of_year',
        'user_id',
        'task_group_id',
        'frequency_id',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'timestamp',
            'end_date' => 'timestamp',
        ];
    }
}
