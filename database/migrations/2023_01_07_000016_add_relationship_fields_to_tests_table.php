<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTestsTable extends Migration
{
    public function up()
    {
        Schema::table('tests', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id', 'doctor_fk_7844115')->references('id')->on('users');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id', 'patient_fk_7844116')->references('id')->on('users');
        });
    }
}
