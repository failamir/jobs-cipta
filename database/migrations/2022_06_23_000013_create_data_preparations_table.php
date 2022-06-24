<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPreparationsTable extends Migration
{
    public function up()
    {
        Schema::create('data_preparations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->nullable();
            $table->integer('akses_file')->nullable();
            $table->integer('akses_video')->nullable();
            $table->integer('akses_forum')->nullable();
            $table->float('kuis_1', 15, 2)->nullable();
            $table->float('kuis_2', 15, 2)->nullable();
            $table->float('tugas_1', 15, 2)->nullable();
            $table->string('tugas_2')->nullable();
            $table->float('nilai_akhir', 15, 2)->nullable();
            $table->string('status_1')->nullable();
            $table->string('status_2')->nullable();
            $table->string('status_3')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
