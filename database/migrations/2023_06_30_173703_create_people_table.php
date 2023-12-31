<?php

use App\Enums\Person\PersonStatus;
use App\Enums\Person\PersonType;
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
            $table->string('cnpj', 19)->nullable();
            $table->string('company_name')->nullable();
            $table->string('trading_name')->nullable();
            $table->char('ie_category', 2)->nullable();
            $table->string('ie', 19)->nullable();
            $table->string('im', 19)->nullable();
            $table->string('cnpj_status')->nullable();
            $table->char('tax_type', 2)->nullable();
            $table->string('cpf', 15)->nullable();
            $table->string('name')->nullable();
            $table->string('alias')->nullable();
            $table->string('rg', 12)->nullable();
            $table->enum('is_active', PersonStatus::toArray());
            $table->longText('observation')->nullable();
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
