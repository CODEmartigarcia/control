<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('work_sessions', function (Blueprint $table) {
            $table->timestamp('start_time')->nullable(false)->change();
            $table->timestamp('end_time')->nullable()->change();
            $table->integer('total_duration')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
