<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('adopter_id')
                ->constrained('adopters')
                ->onDelete('restrict');

            $table->foreignId('shelter_animal_id')
                ->constrained('shelter_animals')
                ->onDelete('restrict');

            $table->date('adoption_date')->nullable();

            $table->decimal('adoption_fee', 10, 2)
                ->default(0);

            $table->string('approval_status', 20)
                ->default('Pending')
                ->index();

            $table->timestamps();

            $table->index([
                'approval_status',
                'adoption_date',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};