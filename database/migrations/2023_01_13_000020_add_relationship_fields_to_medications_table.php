<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMedicationsTable extends Migration
{
    public function up()
    {
        Schema::table('medications', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->foreign('doctor_id', 'doctor_fk_7844082')->references('id')->on('users');
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id', 'patient_fk_7844083')->references('id')->on('users');
            $table->unsignedBigInteger('drug_id')->nullable();
            $table->foreign('drug_id', 'drug_fk_7870884')->references('id')->on('drugs');
        });
    }
}
