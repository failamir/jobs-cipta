<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppliedJobsTable extends Migration
{
    public function up()
    {
        Schema::table('applied_jobs', function (Blueprint $table) {
            $table->unsignedBigInteger('candidate_id')->nullable();
            $table->foreign('candidate_id', 'candidate_fk_6840029')->references('id')->on('users');
            $table->unsignedBigInteger('job_id')->nullable();
            $table->foreign('job_id', 'job_fk_6840030')->references('id')->on('jobs');
        });
    }
}
