<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks_grades', function (Blueprint $table) {
            $table->id();
            $table->string('grade_name')->nullable();
            $table->string('grade_point')->nullable();
            $table->string('start_marks')->nullable();
            $table->string('end_marks')->nullable();
            $table->string('start_point')->nullable();
            $table->string('end_point')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('marks_grades');
    }
}
