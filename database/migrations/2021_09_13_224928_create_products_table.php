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
            $table->integer('admin_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id');
            $table->string('product_name_en');
            $table->string('product_slug_en');
            $table->integer('product_code');
            $table->integer('quantity');
            $table->string('product_size_en')->nullable();
            $table->string('product_color_en');
            $table->integer('product_actual_price');
            $table->integer('product_discount_price')->nullable();
            $table->string('short_desc_en');
            $table->string('long_desc_en');
            $table->string('product_thumbnail')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('offer')->nullable();
            $table->integer('status')->default(0);

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
