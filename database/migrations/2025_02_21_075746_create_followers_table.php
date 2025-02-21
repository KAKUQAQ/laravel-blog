<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('被关注的用户ID');
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade')->comment('粉丝的用户ID');
            $table->timestamps();

            $table->unique(['user_id', 'follower_id']);  // 防止重复关注
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
};

