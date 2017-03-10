<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->unsigned();
            $table->integer('id_doanvan')->nullable(); //default null, Kieu cau hoi la 7 thi day se tro thanh id cua doan van tham chieu
            $table->longtext('content');
            $table->longtext('answer'); //Put the json with the answer here {"Answer 1","Answer 2","Answer 3","Answer 4"}
            $table->timestamps();

            $table->foreign('type')->references('id')->on('question_types')->onDelete('cascade');; //Set the foreign key
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
