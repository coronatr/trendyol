<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrendyolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trendyol', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id');
            $table->integer('parent_id')->nullable();
            $table->unsignedBigInteger('site_id')->index();
            $table->string('name')->index();
            $table->tinyInteger('status')->default(1);// 1 = aktif 0= pasif
            $table->tinyInteger('is_last')->default(0);//1= son kategori
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trendyol');
    }
}
