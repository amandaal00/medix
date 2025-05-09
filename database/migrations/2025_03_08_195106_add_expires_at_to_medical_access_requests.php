<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('medical_access_requests', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('medical_access_requests', function (Blueprint $table) {
            $table->dropColumn('expires_at');
        });
    }
};
