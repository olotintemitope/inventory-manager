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
            $table->integer('item_id')->unassigned();
            $table->integer('business_id')->unassigned();
            $table->double('price', 8, 2);
            $table->integer('quantity');
            $table->double('total_vat', 8, 2);
            $table->integer('total_quantity');
            $table->double('total_amount', 8, 2);
            $table->double('total_base_amount', 8, 2);
            $table->string('customer_name');
            $table->timestamps();

            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->onDelete('cascade');

            $table->foreign('item_id')
                ->references('id')
                ->on('categories')
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
