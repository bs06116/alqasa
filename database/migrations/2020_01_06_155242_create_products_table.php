<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable(); //add department
            $table->unsignedBigInteger('sub_department_id')->nullable(); //add sub-department

            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->text('details')->nullable();
            $table->text('details_en')->nullable();
            $table->text('information')->nullable();
            $table->text('information_en')->nullable();
            $table->text('picture')->nullable();

            $table->integer('min_limit')->default(0);//add min limit
            $table->string('discount_percent')->nullable();
            $table->decimal('price_before',8,2)->default(0);
            $table->decimal('price_after',8,2)->default(0);
            $table->string('size')->nullable();
            $table->enum('promo_code',[0,1])->default(1); //make client to use promo code or not
            $table->integer('visits')->default(0);
            $table->enum('special',[0,1])->default(0); //make user special or not
            $table->enum('active',[0,1])->default(1);

            $table->timestamps();

            //Relation
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sub_department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('area_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_departments');
    }
}
