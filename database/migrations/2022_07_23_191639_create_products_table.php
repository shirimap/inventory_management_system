<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('type');
            $table->double('quantity',17,8);
            $table->double('bprice',17,8);
            $table->double('pprofit',17,8)->nullable()->default(NULL);
            $table->double('sub_amount',17,8)->nullable()->default(NULL);
            $table->double('sub_quantity',17,8)->nullable()->default(NULL);
            $table->double('amount',17,8);
            $table->double('capital',17,8);
            $table->double('discount',17,8)->default(0);
            $table->double('net_amount',17,8);
            $table->foreignId('branch_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable()->default(NULL);
            // $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}