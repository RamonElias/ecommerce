<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
      $table->bigIncrements('id');

      $table->bigInteger('category_id');
      $table->string('name');
      $table->text('description');
      $table->integer('quantity');
      $table->integer('price');
      $table->string('color')->default('#ABCABC');

      $table->timestamps();

      $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');
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
