<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('microwave_results', function ($table) {
            $table->float('totally_power')->virtualAs('(power / 3600) * time')->after('power');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('microwave_results', function ($table) {
            $table->dropColumn('totally_power');
        });
    }
};
