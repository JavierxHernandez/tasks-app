<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskGroup()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    public function frequency()
    {
        return $this->belongsTo(Frequency::class);
    }
}
