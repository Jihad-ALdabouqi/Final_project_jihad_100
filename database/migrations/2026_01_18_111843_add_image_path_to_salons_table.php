<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('salons', function (Blueprint $table) {
            // أضف الحقل الجديد
            $table->string('image_path')->nullable()->after('location');
        });
    }

    public function down()
    {
        Schema::table('salons', function (Blueprint $table) {
            // احذف الحقل عند التراجع
            $table->dropColumn('image_path');
        });
    }
};