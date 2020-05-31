<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPropertyToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('kelas_id')->after('id')->nullable();
            $table->string('nomor_induk')->after('password')->nullable();
            $table->string('phone')->after('nomor_induk')->nullable();
            $table->string('ttl')->after('phone')->nullable();
            $table->text('address')->after('ttl')->nullable();
            $table->string('jabatan')->after('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
