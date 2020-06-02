<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFeePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fee_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('amount');
            $table->integer('method');
            $table->integer('bursar_id');
            $table->string('reference');
            $table->integer('year_id')->nullable();
            $table->integer('type_id');
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
        Schema::dropIfExists('student_fee_payments');
    }
}
