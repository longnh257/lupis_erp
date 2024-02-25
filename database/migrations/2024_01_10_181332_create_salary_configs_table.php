<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salary_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('salary_type', ['by_shift', 'by_revenue'])->default('by_shift');
            $table->decimal('basic_salary', 10, 2)->default(0);
            $table->decimal('basic_salary_per_shift', 10, 2)->nullable();
            $table->decimal('bonus_percentage', 5, 2)->nullable();
            $table->decimal('revenue_percentage', 5, 2)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_configs');
    }
};
