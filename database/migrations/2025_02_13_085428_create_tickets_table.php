<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('attraction_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['active', 'cancelled', 'refunded'])->default('active');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('tickets');
    }
};
