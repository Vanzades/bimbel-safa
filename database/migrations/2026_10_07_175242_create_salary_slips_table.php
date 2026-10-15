<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_slips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->restrictOnDelete();

            $table->string('period');
            $table->date('issued_at');

            $table->decimal('attendance_incentive', 15, 2)->default(0);
            $table->decimal('regular_teaching_honor', 15, 2)->default(0);
            $table->decimal('private_teaching_honor', 15, 2)->default(0);
            $table->decimal('overtime', 15, 2)->default(0);
            $table->decimal('health_allowance', 15, 2)->default(0);
            $table->decimal('bonus', 15, 2)->default(0);

            $table->decimal('loan_deduction', 15, 2)->default(0);
            $table->decimal('income_tax', 15, 2)->default(0);

            $table->unsignedInteger('play_calistung_sd_count')->default(0);
            $table->unsignedInteger('smp_count')->default(0);
            $table->unsignedInteger('sma_count')->default(0);
            $table->decimal('private_count', 10, 2)->default(0);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('received_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['teacher_id', 'period']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_slips');
    }
};
