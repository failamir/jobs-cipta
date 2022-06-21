<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobAlertsTable extends Migration
{
    public function up()
    {
        Schema::table('job_alerts', function (Blueprint $table) {
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id', 'candidate_fk_6840117')->references('id')->on('users');
            $table->unsignedBigInteger('job_id')->nullable();
            $table->foreign('job_id', 'job_fk_6840118')->references('id')->on('jobs');
        });
    }
}
