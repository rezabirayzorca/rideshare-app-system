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
       Schema::create('rides', function (Blueprint $table) {
        $table->id();
        $table->string('origin');
        $table->string('destination');
        $table->date('date')->nullable();
        $table->time('time')->nullable();
        $table->integer('available_seats')->default(1);
        $table->decimal('price_per_seat', 8, 2)->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
