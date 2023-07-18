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
        Schema::disableForeignKeyConstraints();
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('share_location');
            $table->string('mobile_number');
            $table->string('phone_number');
            $table->string('business_logo')->nullable();
            $table->string('logo_note')->nullable();
            $table->string('business_banner')->nullable();
            $table->boolean('request_photoshot')->default(0);
            $table->boolean('do_you_have_delivery')->default(0);
            $table->boolean('request_redesign_logo')->default(0);
            $table->boolean('request_new_logo')->default(0);
            $table->string('delivery_company_name')->nullable();
            $table->text('other_info')->nullable();
            $table->string('other_business_type')->nullable();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->constrained('packages')->onDelete('cascade');
            $table->foreignId('business_type_id')->constrained('business_types')->onDelete('cascade');
            $table->foreignId('main_language_id')->constrained('languages')->onDelete('cascade');
            $table->foreignId('second_language_id')->constrained('languages')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('businesses');
    }
};
