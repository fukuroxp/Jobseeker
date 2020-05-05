<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreignId('employee_id');
            $table->string('ref_no');
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 22, 2);
            $table->string('method');
            $table->timestamps();
            
            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_payments');
    }
}
