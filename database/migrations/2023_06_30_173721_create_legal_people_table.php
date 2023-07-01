<?php

use App\Enums\Person\StateRegistrationCategory;
use App\Enums\Person\TaxCollectionType;
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
        Schema::create('legal_people', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj')->unique();
            $table->string('company_name');
            $table->string('trading_name');
            $table->enum('ie_category', StateRegistrationCategory::toArray());
            $table->string('ie')->nullable();
            $table->string('im')->nullable();
            $table->string('cnpj_status')->nullable();
            $table->enum('tax_type', TaxCollectionType::toArray());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_people');
    }
};
