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
            $table->string('image');
            $table->integer('amount')->default(0);
            $table->double('import_price')->nullable();
            $table->double('product_price')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->double('sale_price')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('category_id');
            $table->integer('subcategory_id');
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
