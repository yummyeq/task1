<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id(); // Уникальный идентификатор
            $table->string('name'); // Название папки
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Идентификатор пользователя
            $table->foreignId('parent_id')->nullable()->constrained('folders')->onDelete('cascade'); // Связь с родительской папкой (если есть)
            $table->timestamps(); // Временные метки
        });
    }

    public function down()
    {
        Schema::dropIfExists('folders'); // Удаление таблицы если миграция откатывается
    }
}