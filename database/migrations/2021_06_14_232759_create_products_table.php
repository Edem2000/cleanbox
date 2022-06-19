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
            $table->string('name_ru');
            $table->string('name_uz');
            $table->string('name_en');
            $table->text('description_ru');
            $table->text('description_uz');
            $table->text('description_en');
            $table->unsignedBigInteger('price');
            $table->boolean('active')->default(1);
            $table->boolean('visible')->default(1);
            $table->text('img')->nullable();
            $table->text('img2')->nullable();
            $table->text('img3')->nullable();
            $table->text('img_doubled')->nullable();
            $table->unsignedInteger('num_sold')->default(0);
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
