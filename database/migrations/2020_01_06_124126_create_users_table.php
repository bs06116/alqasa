<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('name_en')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('address_en')->nullable();
            $table->string('google_lat')->nullable();
            $table->string('google_lan')->nullable();

            $table->text('picture')->nullable();
            $table->text('profile')->nullable();
            $table->text('profile_en')->nullable();
            $table->text('tags')->nullable(); //add tag words and between them (,)
            $table->text('tags_en')->nullable(); //add tag words and between them (,)

            $table->decimal('delivery_price',8,2)->default(0);
            $table->enum('booking_type',[1,2])->default(1); //choose payment method 1 for in kent or 2 for in delivery
            $table->string('reservation_prayer_hour')->nullable(); //make prayer hour to reservation (1,2,3,4,5)

            $table->enum('special',[0,1])->default(0); //make user special or not
            $table->integer('visits')->default(0);

            $table->rememberToken();
            $table->unsignedBigInteger('general_department_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->enum('active',[0,1])->default(1);
            $table->enum('disable',[0,1])->default(0);
            $table->timestamps();

            //Relation
            $table->foreign('general_department_id')->references('id')->on('general_departments')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('users');
    }
}
