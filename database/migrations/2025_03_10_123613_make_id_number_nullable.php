<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_number')->nullable()->change(); // Boleh NULL
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('id_number')->nullable(false)->change(); // Kembalikan ke NOT NULL
        });
    }
};
