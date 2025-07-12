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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            $table->string('place_name');
            $table->text('place_description');
            $table->enum('place_type', ['studio', 'field', 'co_working', 'meeting_room', 'etc'])->default('etc');
            $table->decimal('place_price_per_hour');
            $table->string('place_location_url')->nullable();
            $table->text('place_address');
            $table->time('place_open_time');
            $table->time('place_close_time');
            $table->decimal('place_income')->default(0);
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
