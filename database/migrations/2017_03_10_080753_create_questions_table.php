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
            $table->integer('question_type_id')->unsigned();
            $table->integer('package_id')->nullable(); //default null, Kieu cau hoi la 7 thi day se tro thanh id cua doan van tham chieu
            $table->longtext('content');
            $table->timestamps();

            $table->foreign('question_type_id')->references('id')->on('question_types')->onDelete('cascade'); //Set the foreign key
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
