<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price');
            $table->integer('quantity');
            $table->double('total_vat')->default(0.00);
            $table->integer('total_quantity')->default(0.00);
            $table->double('total_amount')->default(0.00);
            $table->double('total_base_amount')->default(0.00);
            $table->string('customer_name');
            $table->integer('item_id')->unsigned();
            $table->integer('business_id')->unsigned();
            $table->timestamps();

            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');

            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
