<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('honor_mengajar_id')->constrained('honormengajars')->onDelete('cascade');
            $table->string('kode_gaji')->unique();
            $table->date('tanggal_gaji');
            $table->integer('jumlah_absen');
            $table->integer('total_absen');
            $table->integer('total_gaji');
            $table->timestamps();
        });

        Schema::create('detail_gaji_tunjangan', function (Blueprint $table) {
            $table->foreignId('gaji_id')->constrained()->onDelete('cascade');
            $table->foreignId('tunjangan_id')->constrained()->onDelete('cascade');
            $table->primary(['gaji_id', 'tunjangan_id']);
        });

        Schema::create('detail_gaji_potongan', function (Blueprint $table) {
            $table->foreignId('gaji_id')->constrained()->onDelete('cascade');
            $table->foreignId('potongan_id')->constrained()->onDelete('cascade');
            $table->primary(['gaji_id', 'potongan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gaji_tunjangan');
        Schema::dropIfExists('gajis');
    }
}
