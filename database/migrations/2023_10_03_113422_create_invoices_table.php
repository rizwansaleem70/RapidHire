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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('payment_status_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->decimal('sub_total')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('total_amount');
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->date('payment_date');
            $table->string('transaction_id');
            $table->string('payment_method_response');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_status_id')->references('id')->on('dictionaries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
