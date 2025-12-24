<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('passport_number')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->date('birth_date')->nullable();
            $table->string('room_type')->nullable(); // double, triple, quad
            $table->json('options')->nullable(); // extra info
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_passengers');
    }
};
