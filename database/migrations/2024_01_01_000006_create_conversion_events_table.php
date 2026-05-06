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
        Schema::create('conversion_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete();
            
            // Event tracking
            $table->string('event_type')->index(); // page_view, form_submit, add_to_cart, checkout_start, payment_complete, etc.
            $table->string('event_category')->nullable(); // marketing, sales, engagement
            $table->string('event_name');
            
            // Context
            $table->string('page_url')->nullable();
            $table->string('page_title')->nullable();
            $table->string('referrer_url')->nullable();
            
            // UTM Parameters
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();
            
            // Device info
            $table->string('device_type')->nullable();
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->ipAddress('ip_address')->nullable();
            
            // Value tracking
            $table->decimal('value', 12, 2)->nullable();
            $table->string('currency')->default('IDR');
            
            // Additional data
            $table->json('properties')->nullable(); // Custom event properties
            $table->string('session_id')->nullable()->index();
            
            $table->timestamps();
            
            $table->index(['event_type', 'created_at']);
            $table->index(['session_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversion_events');
    }
};
