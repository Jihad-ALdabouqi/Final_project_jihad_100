<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salon_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('coin_cost')->default(0); // كوينز يُدفع عند الاستخدام
            $table->integer('discount')->default(0); // قمية الخصم بناءا على قيمية الكوين الي سيدفع عند الاستخدام   10 %قمية الخصم 
            $table->integer('coins_earned')->default(0); // كوينز يُكسب بعد التأكيد
            $table->boolean('is_active')->default(true);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
