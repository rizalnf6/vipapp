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
            $table->text('address')->nullable();
            $table->string('building_size')->nullable();
            $table->string('land_owner_name')->nullable();
            $table->string('land_owner_address')->nullable();
            $table->string('land_owner_phone_number')->nullable();
            $table->string('villa_manager_name')->nullable();
            $table->string('villa_manager_contact')->nullable();
            $table->string('villa_manager_email')->nullable();
            $table->string('land_size')->nullable();
            $table->string('land_certification_number');
            $table->string('imb_pbg_number');
            $table->string('pln_id');
            $table->string('xtc_power');
            $table->string('licence');
            $table->boolean('for_sale');
            $table->string('for_sale_link')->nullable();
            $table->date('rental_date');
            $table->date('lease_date');
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
