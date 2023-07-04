<?php

use App\Enums\Person\PersonStatus;
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
            $table->string('cnpj', 19)->unique()->nullable();
            $table->string('company_name')->nullable();
            $table->string('trading_name')->nullable();
            $table->enum('ie_category', StateRegistrationCategory::toArray())->nullable();
            $table->string('ie', 19)->nullable();
            $table->string('im', 19)->nullable();
            $table->string('cnpj_status')->nullable();
            $table->enum('tax_type', TaxCollectionType::toArray())->nullable();
            $table->string('cpf', 15)->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('alias')->nullable();
            $table->string('rg', 12)->nullable();
            $table->enum('is_active', PersonStatus::toArray());
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
