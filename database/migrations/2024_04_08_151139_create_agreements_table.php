<?php

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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('villa_id')->constrained()->onDelete('cascade');
            $table->boolean('signed_copy')->nullable();
            $table->string('booking_commision')->nullable();
            $table->boolean('fix_monthly_fee')->nullable();
<<<<<<< HEAD
            $table->string('agent_fee')->nullable();
            $table->string('other_commision')->nullable();
=======
            $table->integer('agent_fee')->nullable();
            $table->integer('other_commision')->nullable();
            $table->string('marketing_agent_sites')->nullable();
            $table->string('marketing_commission')->nullable();
>>>>>>> 95e4cd815e9eea1c6152c7b93b9dedbf6221521c
            $table->string('agreement_document')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
