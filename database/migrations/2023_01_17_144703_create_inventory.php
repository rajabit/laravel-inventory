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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id')->index();
            $table->string('order_type')->index();

            $table->unsignedBigInteger('product_id')->index();
            $table->string('product_type')->index();

            $table->string('caption')->nullable();

            $table->unsignedBigInteger('price')->nullable();

            $table->bigInteger('quantity');
            $table->bigInteger('balance')->nullable();

            $table->dateTime('started_at')->nullable()->index();
            $table->dateTime('expired_at')->nullable()->index();

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
        Schema::dropIfExists('inventory');
    }
};