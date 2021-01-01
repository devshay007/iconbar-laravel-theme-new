<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',50)->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });

    }
}
