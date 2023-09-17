<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->text('item_code')->nullable();
            $table->text('image')->nullable();
            $table->string('name');
            $table->integer('price');
            $table->integer('discount_percent')->default(0);
            $table->timestamp('discount_start_date');
            $table->timestamp('discount_end_date');
            $table->integer('shop_id');
            $table->boolean('is_active')->default(true);
            $table->integer('category_id');
            $table->integer('added_by')->nullable();
            $table->text('stats')->nullable();
            $table->text('object_3d')->nullable();
            $table->text('object_gltf')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('items');
    }
};
