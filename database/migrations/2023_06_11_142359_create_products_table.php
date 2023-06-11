<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal("price", 6, 2);
            $table->integer('discount');
            $table->boolean('favorite');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('demo.cash_mashin');
    }
};
