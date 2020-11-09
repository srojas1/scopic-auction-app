	<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class CreateBidsTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('bids', function (Blueprint $table) {
						$table->increments('id');
						$table->unsignedBigInteger('user_id');
						$table->integer('auction_id')->unsigned();
						$table->integer('price')->unsigned();
						$table->timestamps();

						$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
						$table->foreign('auction_id')->references('id')->on('auction_items')->onDelete('cascade');
				});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
				Schema::dropIfExists('bids');
		}
	}
