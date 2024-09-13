<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {

            // Add polymorphic columns (commentable_id and commentable_type) if they don't exist
            if (!Schema::hasColumn('comments', 'commentable_id') && !Schema::hasColumn('comments', 'commentable_type')) {
                $table->morphs('commentable'); // Adds commentable_id and commentable_type
            }
        });
    }
    
};
