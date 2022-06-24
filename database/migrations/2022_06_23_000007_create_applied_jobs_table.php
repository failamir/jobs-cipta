<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliedJobsTable extends Migration
{
    public function up()
    {
        Schema::create('applied_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->nullable();
            $table->string('crew_code')->nullable();
            $table->date('date_of_entry')->nullable();
            $table->string('source')->nullable();
            $table->string('department')->nullable();
            $table->date('d_o_b')->nullable();
            $table->string('vaccination_yf')->nullable();
            $table->string('vaccination_covid_19')->nullable();
            $table->string('cid')->nullable();
            $table->string('coc')->nullable();
            $table->string('rating_able')->nullable();
            $table->string('ccm')->nullable();
            $table->string('application_form')->nullable();
            $table->date('interview_date')->nullable();
            $table->string('interview_by')->nullable();
            $table->string('interview_result')->nullable();
            $table->string('approved_as')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
