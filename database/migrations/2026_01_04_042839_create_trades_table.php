<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();

            // RELATION
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('stock_id')
                ->constrained()
                ->cascadeOnDelete();

            // TRADE INFO
            $table->date('trade_date');

            $table->enum('position', ['buy', 'sell']);

            $table->decimal('entry_price', 15, 2);
            $table->decimal('take_profit', 15, 2);
            $table->decimal('stop_loss', 15, 2);

            // EXIT (nullable karena open posisi)
            $table->decimal('exit_price', 15, 2)->nullable();
            $table->date('exit_date')->nullable();

            $table->enum('status', ['open', 'closed'])->default('open');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
