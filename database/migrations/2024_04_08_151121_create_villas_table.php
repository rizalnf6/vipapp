<?php

use App\Enums\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->enum('category', Category::asArray());
            $table->string('name');
            $table->text('address');
            $table->string('building_size');
            $table->string('land_size');
            $table->string('land_owner');
            $table->string('land_certification_number');
            $table->string('imb_pbg_number');
            $table->string('licence');
            $table->date('rental_date');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villas');
    }
};
