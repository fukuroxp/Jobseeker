<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('ttl');
            $table->string('asal');
            $table->string('domisili');
            $table->string('notelpon');
            $table->string('email')->unique();
            $table->string('tb');
            $table->string('bb');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->string('hobi');
            $table->string('skill');
            $table->string('sd')->nullable();
            $table->string('ijazahsd')->nullable();
            $table->string('smp')->nullable();
            $table->string('ijazahsmp')->nullable();
            $table->string('sma')->nullable();
            $table->string('ijazahsma')->nullable();
            $table->string('s1')->nullable();
            $table->string('ijazahs1')->nullable();
            $table->string('s2')->nullable();
            $table->string('ijazahs2')->nullable();
            $table->string('s3')->nullable();
            $table->string('ijazahs3')->nullable();
            $table->string('kursus')->nullable();
            $table->string('bukti')->nullable();
            $table->enum('kategori', ['Kampus', 'Karang Taruna', 'Sekolah', 'Remaja Masjid'])->nullable();
            $table->string('jabatan')->nullable();
            $table->string('periode')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('bagian')->nullable();
            $table->string('lama_bekerja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
