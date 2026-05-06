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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_source_id')->nullable()->constrained()->nullOnDelete();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->index();
            $table->string('phone')->nullable();
            $table->string('whatsapp_number')->nullable();
            
            // Lead tracking
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();
            $table->string('referrer_url')->nullable();
            $table->string('landing_page')->nullable();
            
            // Device & Browser info
            $table->string('device_type')->nullable(); // mobile, tablet, desktop
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->ipAddress('ip_address')->nullable();
            
            // Interest tracking
            $table->foreignId('package_id')->nullable()->constrained()->nullOnDelete();
            $table->date('preferred_travel_date')->nullable();
            $table->integer('number_of_passengers')->default(1);
            $table->decimal('estimated_budget', 12, 2)->nullable();
            
            // Status
            $table->enum('status', ['new', 'contacted', 'qualified', 'proposal_sent', 'negotiation', 'converted', 'lost'])->default('new');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->text('notes')->nullable();
            $table->timestamp('converted_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for performance
            $table->index(['status', 'created_at']);
            $table->index(['email', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
