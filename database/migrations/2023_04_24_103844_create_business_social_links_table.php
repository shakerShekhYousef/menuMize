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
        Schema::create('business_social_links', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('social_link_type_id')->constrained('social_link_types')->onDelete('cascade');
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
        Schema::dropIfExists('business_social_links');
    }
};
