<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('ex_id');
            $table->string('country')->nullable();
            $table->string('title')->nullable();
            $table->string('industry')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fullName')->nullable();
            $table->string('position')->nullable();
            $table->string('advertising')->nullable();
            $table->tinyInteger('visitor')->default(0);
            $table->string('input_1')->nullable();
            $table->string('input_2')->nullable();
            $table->string('input_3')->nullable();
            $table->string('input_4')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('members');
    }
}
