<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');

            $table->string('locale', 5)->index();
            $table->integer('form_id')->unsigned();

            $table->foreign('form_id')
                ->references('id')->on('forms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_translations');
    }
}
