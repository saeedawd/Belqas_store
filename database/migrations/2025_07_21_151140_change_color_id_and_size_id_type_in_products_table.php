<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColorIdAndSizeIdTypeInProductsTable extends Migration
{
public function up(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->unsignedBigInteger('color_id')->nullable()->change();
        $table->unsignedBigInteger('size_id')->nullable()->change();
    });
}


    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('color_id')->change();
            $table->string('size_id')->change();
        });
    }
}
