<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegisterMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('st_id');
            $table->string('session');
            $table->string('batch');
            $table->string('shift');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->string('mobile')->unique();
            $table->string('otp');
            $table->string('department');
            $table->string('email')->unique(); 
            $table->integer('otp_verify');
            $table->integer('step_1');
            $table->integer('step_2');
            $table->integer('step_3'); 
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
        //
    }
}
