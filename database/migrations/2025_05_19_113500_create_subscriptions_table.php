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
       Schema::create('subscriptions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->string('plan_id');
    $table->string('mp_subscription_id')->nullable();
    $table->string('mp_preference_id')->nullable();
    $table->string('status')->default('pending');
    $table->datetime('start_date')->nullable();
    $table->datetime('end_date')->nullable();
    $table->datetime('next_payment')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
