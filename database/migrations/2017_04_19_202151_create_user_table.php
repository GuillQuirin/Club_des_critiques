<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->text('description');
            $table->string('picture', 150)->nullable()->default(null);
            $table->string('location', 100);
            $table->string('email', 100)->unique();
            $table->integer('status');
            $table->string('password',60);
            $table->string('token',100);
            $table->boolean('is_reported')->default(false);
            $table->boolean('is_contactable')->default(true);
            $table->timestamps('date_created');
            $table->timestamps('date_updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
