<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('snippet_id');
            $table->tinyInteger('score');
            $table->timestamps();

            $table->unique(['user_id', 'snippet_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
