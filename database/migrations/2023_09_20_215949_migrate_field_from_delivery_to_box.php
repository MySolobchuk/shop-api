<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn([
                'methodPayment',
            ]);
		});

        Schema::table('boxes', function (Blueprint $table) {
            $table->string('methodPayment')->nullable();
        });
	}

	public function down(): void
	{
        Schema::table('boxes', function (Blueprint $table) {
            $table->dropColumn([
                'methodPayment',
            ]);
        });

        Schema::table('deliveries', function (Blueprint $table) {
            $table->string('methodPayment')->nullable();
        });
	}
};
