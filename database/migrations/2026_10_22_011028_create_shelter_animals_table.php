<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shelter_animals', function (Blueprint $table) {
            $table->id();
            $table->string('animal_type', 50);
            $table->string('pet_name', 100)->nullable();
            $table->string('microchip_id', 50)
                ->nullable()
                ->unique();
            $table->date('intake_date');
            $table->string('spay_neuter_status', 30)
                ->default('Pending')
                ->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelter_animals');
    }
};