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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->longText('description')->nullable();
            $table->date('publication_date')->nullable();
            $table->enum('status',array(0,1))->default(1)->comment('0 = INACTIVE || 1 = ACTIVE');
            $table->softDeletes();    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
