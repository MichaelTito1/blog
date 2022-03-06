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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // $table->integer('year');
            $table->string('month', 3);
            $table->date('salaries_payment_day');
            $table->date('bonus_payment_day');
            $table->decimal('salaries_total');
            $table->decimal('bonus_total');
            $table->decimal('payments_total');
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
