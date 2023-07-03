<?php

use App\Enums\Person\PersonType;
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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->enum('type', PersonType::toArray());
            $table->string('cnpj')->unique()->nullable();
            $table->string('company_name')->nullable();
            $table->string('trading_name')->nullable();
            $table->enum('ie_category', StateRegistrationCategory::toArray())->nullable();
            $table->string('ie', 15)->nullable();
            $table->string('im', 15)->nullable();
            $table->string('cnpj_status')->nullable();
            $table->enum('tax_type', TaxCollectionType::toArray())->nullable();
            $table->string('cpf', 11)->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('alias')->nullable();
            $table->string('rg', 9)->nullable();
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
