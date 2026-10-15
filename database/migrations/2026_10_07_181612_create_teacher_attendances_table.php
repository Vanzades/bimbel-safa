<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->restrictOnDelete();

            $table->foreignId('branch_id')
                ->nullable()
                ->constrained('branches')
                ->nullOnDelete();

            $table->date('date');

            $table->enum('status', [
                'present',
                'permission',
                'sick',
                'absent',
            ])->default('present');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(
                ['teacher_id', 'date'],
                'teacher_attendances_teacher_date_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_attendances');
    }
};