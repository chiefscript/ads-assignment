<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->text('title');
            $table->foreignId('office_id');
            $table->double('grant_amount')->nullable();
            $table->date('gcf_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('first_disbursement');
            $table->foreignId('status_id');
            $table->foreignId('readiness_type_id')->nullable();
            $table->enum('read_nap', ['Readiness', 'National Adaptation Plans']);
            $table->foreignId('created_by');
            $table->timestamps();
            $table->foreign('office_id')->references('id')->on('offices');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('readiness_type_id')->references('id')->on('readiness_types');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
