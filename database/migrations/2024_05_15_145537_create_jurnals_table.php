<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gaji_id')->constrained('gajis')->onDelete('cascade');
            $table->foreignId('akun_debit_id')->constrained('akuns')->onDelete('cascade');
            $table->foreignId('akun_kredit_id')->constrained('akuns')->onDelete('cascade');
            $table->string('keterangan');
            $table->integer('jumlah_akun_debit');
            $table->integer('jumlah_akun_kredit');
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
        Schema::dropIfExists('jurnals');
    }
}
