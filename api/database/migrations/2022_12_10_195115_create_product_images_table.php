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
        Schema::create('product_images', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->foreignUuid('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('url');
            $table->timestamps();
        });

        Schema::table("products", function (Blueprint $table) {
            $table->foreignUuid('thumbnail')->nullable()->constrained("product_images")->cascadeOnDelete()->cascadeOnUpdate()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }
};
