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
       Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_number')->unique()->comment('RV-001, PV-001');
            $table->string('reference_number')->nullable();
            $table->date('date');
            $table->string('from_to')->comment('receive_from for RV, pay_to for PV');
            $table->text('description');
            $table->string('bank_code', 20)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->text('terbilang')->nullable()->comment('Amount in words');
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->enum('type', ['receive', 'payment'])->comment('receive = RV, payment = PV');
            $table->timestamps();

            // Indexes for performance
            $table->index(['voucher_number']);
            $table->index(['date']);
            $table->index(['type']);
        });

        // Create voucher details table
        Schema::create('voucher_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_id')->constrained('vouchers')->onDelete('cascade');
            $table->string('account_number', 50);
            $table->string('account_name');
            $table->decimal('amount', 15, 2);
            $table->integer('line_number')->default(1)->comment('Order of account lines');
            $table->timestamps();

            // Indexes
            $table->index(['voucher_id']);
            $table->index(['account_number']);
            $table->index(['voucher_id', 'line_number']); // Composite index
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
        Schema::dropIfExists('voucher_details');
    }
};
