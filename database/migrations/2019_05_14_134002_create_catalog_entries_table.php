<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cat_field_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('cat_field_id')->references('id')->on('catalog_fields');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('value')->default('');
            $table->boolean('active');
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
        Schema::dropIfExists('catalog_entries');
    }
}
