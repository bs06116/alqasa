<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->decimal('price',8,2)->default(0);
            $table->integer('count')->default(0);
            $table->decimal('total_price',8,2)->default(0); //price after promo code
            $table->enum('active',[0,1])->default(1);
            $table->timestamps();

            //relations
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_details');
    }
}
