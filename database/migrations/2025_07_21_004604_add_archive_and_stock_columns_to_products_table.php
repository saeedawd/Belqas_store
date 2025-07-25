<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_archived')->default(false)->after('status');
            $table->boolean('in_stock')->default(true)->after('is_archived');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_archived');
            $table->dropColumn('in_stock');
        });
    }

};
