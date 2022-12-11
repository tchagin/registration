<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');

            $table->string('locale', 5)->index();
            $table->integer('industry_id')->unsigned();

            $table->foreign('industry_id')
                ->references('id')->on('industries')
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
        Schema::dropIfExists('industry_translations');
    }
}
