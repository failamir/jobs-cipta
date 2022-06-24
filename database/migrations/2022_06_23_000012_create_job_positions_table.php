<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPositionsTable extends Migration
{
    public function up()
    {
        Schema::create('job_positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_position')->nullable();
            $table->longText('description_position')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
