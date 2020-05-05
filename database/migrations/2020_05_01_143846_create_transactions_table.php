<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreignId('employee_id');
            $table->string('ref_no');
            $table->string('type');
            $table->string('status');
            $table->string('payment_status');
            $table->decimal('total', 22, 2)->nullable();
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables');
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
        Schema::dropIfExists('transactions');
    }
}
