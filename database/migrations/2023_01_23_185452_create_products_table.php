<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80)->comment('Название товара');
            $table->string('label', 80)->comment('Лейбл товара')->nullable();
            $table->text('description')->comment('Описание товара')->nullable();
            $table->float('first_price')->comment('Первая цена');
            $table->float('price')->comment('Цена');
            $table->integer('code')->comment('Код товара');
            $table->string('preview')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
