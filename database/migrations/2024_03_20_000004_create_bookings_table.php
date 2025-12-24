<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->string('booking_code')->unique(); // e.g., UMROH-2024-0001
            $table->date('booking_date');

            // Financials
            $table->integer('total_passengers')->default(1);
            $table->decimal('base_price', 15, 2);
            $table->decimal('total_price', 15, 2); // after calculations

            // Statuses
            $table->enum('status', ['pending', 'confirmed', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'partial', 'paid', 'refunded'])->default('unpaid');
            $table->string('payment_method')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
