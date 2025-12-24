<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('category', ['reguler', 'plus', 'vip']);
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2);
            $table->decimal('discount_price', 15, 2)->nullable();
            $table->date('departure_date');
            $table->date('return_date');
            $table->integer('duration_days');
            $table->integer('total_seats');
            $table->integer('available_seats');
            $table->string('airline')->nullable();
            $table->string('makkah_hotel_name')->nullable();
            $table->integer('makkah_hotel_stars')->default(0);
            $table->string('makkah_hotel_distance')->nullable(); // e.g., "50m"
            $table->string('madinah_hotel_name')->nullable();
            $table->integer('madinah_hotel_stars')->default(0);
            $table->string('madinah_hotel_distance')->nullable();
            $table->string('status')->default('draft'); // draft, published, archived
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('view_count')->default(0);
            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
