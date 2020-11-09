<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_items', function (Blueprint $table) {
					$table->increments('id');
					$table->string('title');
					$table->string('description');
					$table->decimal('price');
					$table->decimal('min_price');
					$table->decimal('max_price');
					$table->date('end_date');
					$table->boolean('status');
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
        Schema::dropIfExists('auction_items');
    }
}
