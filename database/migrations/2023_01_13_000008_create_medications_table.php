<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('purpose');
            $table->longText('usage');
            $table->string('isread')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
