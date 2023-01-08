<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->datetime('date');
            $table->string('isread')->nullable();
            $table->string('tip');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
