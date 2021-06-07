<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id');
            $table->string('name')->nullable();
            $table->decimal('amount',8,2)->default(0);
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->integer('only_user_count')->default(0); //count of how only one user use it
            $table->integer('users_count')->default(0); //count of how many users use it
            $table->enum('active',[0,1])->default(1);
            $table->timestamps();

            //Relation
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
}
