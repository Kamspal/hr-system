<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('position_id')->unsigned();
            $table->foreign('position_id')->references('id')->on('positions')->onUpdate('cascade');

            $table->decimal('basic_salary', 9, 2);
            $table->decimal('hra', 9, 2);
            $table->decimal('da', 9, 2);
            $table->decimal('other_allowances', 9, 2);
            $table->decimal('gross_salary', 9, 2);

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
        Schema::dropIfExists('salaries');
    }
}
