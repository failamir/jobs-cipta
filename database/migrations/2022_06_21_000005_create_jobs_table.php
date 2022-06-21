<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->date('date_posted')->nullable();
            $table->date('date_expired')->nullable();
            $table->longText('job_description')->nullable();
            $table->longText('requirement')->nullable();
            $table->longText('procedure_recruitment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
