<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('trades', function (Blueprint $table) {

        // CLOSE INFO
        $table->decimal('closed_price', 15, 2)->nullable()
              ->after('stop_loss');

        $table->timestamp('closed_at')->nullable()
              ->after('closed_price');

        $table->enum('result', ['win', 'loss', 'be'])->nullable()
              ->after('closed_at');

        $table->decimal('profit_loss', 15, 2)->nullable()
              ->after('result');
    });
}

public function down(): void
{
    Schema::table('trades', function (Blueprint $table) {
        $table->dropColumn([
            'closed_price',
            'closed_at',
            'result',
            'profit_loss',
        ]);
    });
}

};
