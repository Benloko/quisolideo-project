<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('unpaid')->after('payment_method');
            $table->string('stripe_session_id')->nullable()->after('payment_status')->index();
            $table->string('stripe_payment_intent_id')->nullable()->after('stripe_session_id');
            $table->timestamp('paid_at')->nullable()->after('stripe_payment_intent_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['paid_at', 'stripe_payment_intent_id', 'stripe_session_id', 'payment_status']);
        });
    }
};
