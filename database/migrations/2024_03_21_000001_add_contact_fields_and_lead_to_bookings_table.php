<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('name')->nullable()->after('user_id');
            $table->string('phone_number')->nullable()->after('name');
            $table->string('email')->nullable()->after('phone_number');
            $table->string('whatsapp_number')->nullable()->after('email');
            $table->date('departure_date')->nullable()->after('booking_date');
            $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete()->after('package_id');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['lead_id']);
            $table->dropColumn(['name', 'phone_number', 'email', 'whatsapp_number', 'departure_date', 'lead_id']);
        });
    }
};
