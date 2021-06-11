<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('status_id')->nullable();
            $table->bigInteger('symptomp_id')->nullable();
            $table->bigInteger('user_contact_id')->nullable();
            $table->bigInteger('user_support_id')->nullable();
            $table->bigInteger('priority_case_id')->nullable();
            $table->text('description')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
