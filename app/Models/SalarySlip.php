<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalarySlip extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'period',
        'issued_at',
        'attendance_incentive',
        'regular_teaching_honor',
        'private_teaching_honor',
        'overtime',
        'health_allowance',
        'bonus',
        'loan_deduction',
        'income_tax',
        'play_calistung_sd_count',
        'smp_count',
        'sma_count',
        'private_count',
        'created_by',
        'received_by',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
            'attendance_incentive' => 'decimal:2',
            'regular_teaching_honor' => 'decimal:2',
            'private_teaching_honor' => 'decimal:2',
            'overtime' => 'decimal:2',
            'health_allowance' => 'decimal:2',
            'bonus' => 'decimal:2',
            'loan_deduction' => 'decimal:2',
            'income_tax' => 'decimal:2',
            'private_count' => 'decimal:2',
        ];
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function getTotalIncomeAttribute(): float
    {
        return (float) $this->attendance_incentive
            + (float) $this->regular_teaching_honor
            + (float) $this->private_teaching_honor
            + (float) $this->overtime
            + (float) $this->health_allowance
            + (float) $this->bonus;
    }

    public function getTotalDeductionAttribute(): float
    {
        return (float) $this->loan_deduction
            + (float) $this->income_tax;
    }

    public function getNetSalaryAttribute(): float
    {
        return $this->total_income - $this->total_deduction;
    }
}
