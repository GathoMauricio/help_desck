<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCompanyBranches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_branches', function (Blueprint $table) {
            $table->string('email')->after('name')->nullable();
            $table->string('phone')->after('email')->nullable();
            $table->text('address')->after('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_branches', function (Blueprint $table) {
            //
        });
    }
}
