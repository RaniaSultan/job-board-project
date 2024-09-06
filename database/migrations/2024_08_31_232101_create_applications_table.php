<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->string('resume')->nullable();
<<<<<<< HEAD
            $table->enum('status', ['waiting', 'accepted', 'rejected'])->default('waiting');
=======
            $table->enum('status', ['waiting', 'accepted', 'rejected', 'cancelled'])->default('waiting');
>>>>>>> 4b30443458334107d4d71a2d16e32d5c4fb8c079
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['user_id', 'post_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};