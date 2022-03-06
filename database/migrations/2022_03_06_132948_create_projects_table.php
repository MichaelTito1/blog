<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('month', 255)->nullable();
            $table->integer('salaries_payment_day')->nullable()->default(1);
            $table->integer('bonus_payment_day')->nullable()->default(15);
            $table->decimal('salaries_total', 22)->nullable()->default(0.00);
            $table->decimal('bonus_total', 22)->nullable()->default(0.00);
            $table->decimal('payments_total', 22)->nullable()->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
