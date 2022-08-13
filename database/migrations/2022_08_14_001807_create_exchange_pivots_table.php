<?php

use App\Models\Country;
use App\Models\CurrencyRate;
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
        Schema::create('exchange_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Country::class)->constrained();
            $table->foreignIdFor(CurrencyRate::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_pivots');
    }
};
