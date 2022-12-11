<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');

            $table->string('locale', 5)->index();
            $table->integer('advertising_id')->unsigned();

            $table->foreign('advertising_id')
                ->references('id')->on('advertisings')
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
        Schema::dropIfExists('advertising_translations');
    }
}
