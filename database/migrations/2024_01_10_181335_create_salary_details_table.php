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
        Schema::create('salary_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('salary_month');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('basic_salary', 10, 2)->default(0);
            $table->decimal('basic_salary_per_shift', 10, 2)->nullable();
            $table->decimal('bonus_percentage', 5, 2)->nullable();
            $table->decimal('revenue_percentage', 5, 2)->nullable();
            $table->integer('order_count')->nullable();
            $table->integer('shift_count')->nullable();
            $table->decimal('salary', 10, 2);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->decimal('total_salary', 10, 2);
            $table->date('payday')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_details');
    }
};
