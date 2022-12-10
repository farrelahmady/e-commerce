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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('store_id')->constrained('stores')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->enum("status", [1, 2])->default(1);
            $table->float('weight')->default(1);
            $table->float('stock')->default(1);
            $table->float('price');
            $table->text('description')->nullable();
            $table->foreignId("category_id")->constrained("products_categories")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->dropForeign(['category_id']);
        });
    }
};
