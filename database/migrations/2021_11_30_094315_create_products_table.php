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
            $table->string('product_code');
            $table->string('name');
            $table->string('product_slug');
            $table->string('image');
            $table->integer('amount');
            $table->double('import_price')->nullable();
            $table->double('product_price');
            $table->text('description');
            $table->double('sale_price')->nullable();
            $table->tinyInteger('status');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('receipt_id')->nullable();
            $table->softDeletes();
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
