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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->float('amount', 8, 2);
            $table->float('vat', 8, 2);
            $table->boolean('vat_inclusive');
            $table->bigInteger('payer_id')->unsigned()->nullable()->index();
            $table->foreign('payer_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('due_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
