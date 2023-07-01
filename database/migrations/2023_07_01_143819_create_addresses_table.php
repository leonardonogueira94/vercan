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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('person_id')->constrained();
            $table->string('cep', 10);
            $table->string('address');
            $table->string('building_number', 7);
            $table->string('complement')->nullable();
            $table->string('area');
            $table->string('reference_point')->nullable();
            $table->boolean('is_condo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('addresses');
        Schema::enableForeignKeyConstraints();
    }
};
