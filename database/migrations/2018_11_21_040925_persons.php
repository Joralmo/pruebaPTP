<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Persons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string("document", 12);
            $table->integer("documentType")->unsigned();
            $table->foreign("documentType")->references("id")->on("documentTypes")->onDelete("cascade");
            $table->string("firstName", 60);
            $table->string("lastName", 60);
            $table->string("company", 60);
            $table->string("emailAddres", 80);
            $table->string("addres", 100);
            $table->string("city", 50);
            $table->string("province", 50);
            $table->string("country", 2);
            $table->string("phone", 30);
            $table->string("mobile", 30);
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
        Schema::dropIfExists('persons');
    }
}
