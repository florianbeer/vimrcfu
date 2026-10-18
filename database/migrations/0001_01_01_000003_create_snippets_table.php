<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('snippets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body');
            $table->text('description');
            $table->integer('user_id');
            $table->timestamps();

            if (in_array(Schema::getConnection()->getDriverName(), ['mysql', 'mariadb'])) {
                $table->fullText(['title', 'body', 'description'], 'search');
                $table->fullText('title', 'search_title');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('snippets');
    }
};
