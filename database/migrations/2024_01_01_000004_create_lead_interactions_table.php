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
        Schema::create('lead_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // Staff who handled interaction
            
            // Interaction type
            $table->enum('type', ['call', 'email', 'whatsapp', 'sms', 'meeting', 'note', 'form_submission', 'website_visit']);
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            
            // Communication details
            $table->string('channel')->nullable(); // phone, email, whatsapp, etc.
            $table->timestamp('occurred_at')->useCurrent();
            $table->integer('duration_seconds')->nullable(); // For calls/meetings
            
            // Follow-up
            $table->timestamp('follow_up_date')->nullable();
            $table->text('follow_up_notes')->nullable();
            $table->boolean('follow_up_completed')->default(false);
            
            // Metadata
            $table->json('metadata')->nullable(); // Additional data like email open tracking, link clicks, etc.
            $table->timestamps();
            
            $table->index(['lead_id', 'occurred_at']);
            $table->index(['type', 'occurred_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_interactions');
    }
};
