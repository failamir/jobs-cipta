<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRegistrationFlowsTable extends Migration
{
    public function up()
    {
        Schema::table('registration_flows', function (Blueprint $table) {
            $table->unsignedBigInteger('job_id')->nullable();
            $table->foreign('job_id', 'job_fk_6840023')->references('id')->on('jobs');
        });
    }
}
