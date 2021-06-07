<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('general_department_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');

            //reservation information
            $table->decimal('price',8,2)->default(0);
            $table->decimal('delivery',8,2)->default(0);
            $table->string('reservation_prayer_hour')->nullable(); //make prayer hour to reservation (1,2,3,4,5)
            $table->enmu('reservation_prayer_hour_time',[1,2])->default(1)->nullable(); //make prayer hour time to reservation (1,2) - 1 for before prayer, 2 fpr after prayer
            $table->time('reservation_time')->nullable();
            $table->date('reservation_date')->nullable();
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('promo_code_id')->nullable();

            //payment information
            $table->enum('active',[0,1])->default(1);

            $table->integer('payment_number')->default(0); //uniqe bill number
            $table->integer('payment_hash_mac')->default(0); //uniqe hash Mac
            $table->integer('payment_id')->default(0); //uniqe payment_id
            $table->integer('payment_statues')->default(0); //choose payment statues 0 for in In progress or 1 for in Delivered
            $table->enum('payment_method',[1,2,3,4])->default(1); //choose payment method 1 for in kent or 2 for in delivery, 3 mastercard, 4 visa
            $table->enum('payment_active',[0,1,2])->default(0); //payment 0 for not, 1 for done and 2 for cancel

            $table->softDeletes();
            $table->timestamps();

            //Relation
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('area_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('general_department_id')->references('id')->on('general_departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('promo_code_id')->references('id')->on('promo_codes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
