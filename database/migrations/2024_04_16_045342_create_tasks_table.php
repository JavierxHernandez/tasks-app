<?php

use App\Models\Frequency;
use App\Models\TaskGroup;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('iteration_count')->nullable();
            $table->string('days')->nullable();
            $table->integer('days_of_month')->nullable();
            $table->integer('months_of_year')->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(TaskGroup::class)->nullable()->constrained();
            $table->foreignIdFor(Frequency::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
