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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            //forgien key with invoices table
            $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
            $table->decimal('amount_paid', 10, 2);
            //payment method
            $table->string('payment_method')->nullable();
            //reference number
            $table->string('reference_number')->nullable();
            //payment date
            $table->date('payment_date')->useCurrent();
            $table->string('notes')->nullable();
            $table->timestamps();
        });

        // Add credit balance and payment status to invoices table
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('credit_balance', 10, 2)->default(0);
            $table->string('payment_status')->default('unpaid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('credit_balance');
            $table->dropColumn('payment_status');
        });
    }
};
