<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 15);
            $table->string('firstName', 15);
            $table->string('email', 50)->unique();
            $table->char('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedBigInteger('center_id');
            $table->foreign('center_id')
                ->references('id')
                ->on('centers')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->unsignedBigInteger('right_id');
            $table->foreign('right_id')
                ->references('id')
                ->on('rights')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
