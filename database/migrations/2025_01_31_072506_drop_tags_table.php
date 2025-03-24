<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTagsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('file_tag'); // Удаление таблицы связи, если есть
        Schema::dropIfExists('tags'); // Удаление таблицы тегов
    }

    public function down()
    {
        // Если нужно, можно дополнить миграцию для создания таблицы обратно
    }
}
