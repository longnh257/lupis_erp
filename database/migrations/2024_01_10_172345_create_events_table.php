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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->date('event_date');
            $table->unsignedBigInteger('user_id');
            $table->string('event_type'); // Loại sự kiện: làm việc, nghỉ phép, vv.
            $table->string('shift'); // Ca làm việc
            $table->boolean('approved')->default(0); // Duyệt hay chưa
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
