<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('program_id')
                ->nullable()
                ->after('class_room_id')
                ->constrained('programs')
                ->nullOnDelete();

            $table->string('birth_place')
                ->nullable()
                ->after('name');

            $table->date('birth_date')
                ->nullable()
                ->after('birth_place');

            $table->string('parent_name')
                ->nullable()
                ->after('address');

            $table->string('parent_phone')
                ->nullable()
                ->after('parent_name');

            $table->text('parent_address')
                ->nullable()
                ->after('parent_phone');

            $table->string('parent_occupation')
                ->nullable()
                ->after('parent_address');

            $table->boolean('previous_tutoring')
                ->default(false)
                ->after('parent_occupation');

            $table->boolean('special_needs')
                ->default(false)
                ->after('previous_tutoring');

            $table->text('notes')
                ->nullable()
                ->after('special_needs');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('class_room_id')->nullable()->change();
            $table->string('identity_number')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['program_id']);

            $table->dropColumn([
                'program_id',
                'birth_place',
                'birth_date',
                'parent_name',
                'parent_phone',
                'parent_address',
                'parent_occupation',
                'previous_tutoring',
                'special_needs',
                'notes',
            ]);
        });
    }
};