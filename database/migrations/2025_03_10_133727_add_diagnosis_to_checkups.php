<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('checkups', function (Blueprint $table) {
            $table->string('diagnosis')->nullable()->after('complaint');
        });
    }

    public function down()
    {
        Schema::table('checkups', function (Blueprint $table) {
            $table->dropColumn('diagnosis');
        });
    }

};
