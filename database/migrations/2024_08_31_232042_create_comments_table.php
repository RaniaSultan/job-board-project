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
        Schema::create('comments', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id();
=======
<<<<<<< HEAD
=======
            $table->id();
>>>>>>> 6fe561d (profile & application)
>>>>>>> c6e38858e84f292d6c94cd1a2403d853469a9cd5
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->text('content');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
<<<<<<< HEAD
            // $table->primary(['user_id', 'post_id']);
            $table->integer('commentable_id')->unsigned(); 
            $table->string('commentable_type');
=======
<<<<<<< HEAD
            $table->primary(['user_id', 'post_id']);
=======
            // $table->primary(['user_id', 'post_id']);
            $table->integer('commentable_id')->unsigned(); 
            $table->string('commentable_type');
>>>>>>> 6fe561d (profile & application)
>>>>>>> c6e38858e84f292d6c94cd1a2403d853469a9cd5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
