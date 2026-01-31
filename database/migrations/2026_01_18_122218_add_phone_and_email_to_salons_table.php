<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::table('salons', function (Blueprint $table) {
        $table->string('phone')->nullable()->after('location');
        $table->string('email')->nullable()->after('phone');
    });
}

    public function down()
    {
        Schema::table('salons', function (Blueprint $table) {
            $table->dropColumn(['phone', 'email']);
        });
    }
};