<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Drop the foreign key constraint before dropping the column
            $table->dropForeign(['post_id']); 
    
            // Now drop the post_id column
            $table->dropColumn('post_id');
    
            // Add polymorphic columns (commentable_id and commentable_type) if they don't exist
            if (!Schema::hasColumn('comments', 'commentable_id') && !Schema::hasColumn('comments', 'commentable_type')) {
                $table->morphs('commentable'); // Adds commentable_id and commentable_type
            }
        });
    }
    
};
