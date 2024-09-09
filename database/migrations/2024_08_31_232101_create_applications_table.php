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

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->string('resume')->nullable();
            $table->enum('status', ['waiting', 'accepted', 'rejected', 'cancelled'])->default('waiting');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
<<<<<<< HEAD
            // $table->primary(['user_id', 'post_id']);
=======
            $table->primary(['user_id', 'post_id']);
>>>>>>> 3151e007923ede765900281740325eaaac05da95
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
<<<<<<< HEAD
};
=======
};
>>>>>>> 3151e007923ede765900281740325eaaac05da95
