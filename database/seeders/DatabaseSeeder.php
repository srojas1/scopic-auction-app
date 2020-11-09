<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
		/**
		 * Seed the application's database.
		 *
		 * @return void
		 */
		public function run()
		{
			DB::table('users')->insert([
				'name' => 'user1',
				'email' => 'samuelro444@gmail.com',
				'password' => Hash::make('user1Pass'),
			]);

			DB::table('users')->insert([
				'name' => 'user2',
				'email' => 'samuel_ro4@hotmail.com',
				'password' => Hash::make('user2Pass'),
			]);

			DB::table('auction_items')->insert([
				'title' => 'Iphone X',
				'description' => 'Used iphone',
				'price' => '500',
				'min_price' => '400',
				'max_price' => '2000',
				'end_date' => '2020-11-30 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Skateboard',
				'description' => 'Used skateboard',
				'price' => '200',
				'min_price' => '50',
				'max_price' => '500',
				'end_date' => '2020-12-01 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Monitor',
				'description' => 'Used monitor',
				'price' => '400',
				'min_price' => '100',
				'max_price' => '1500',
				'end_date' => '2020-12-02 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Keyboard',
				'description' => 'Used keyboard',
				'price' => '50',
				'min_price' => '10',
				'max_price' => '100',
				'end_date' => '2020-12-03 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Iphone 11',
				'description' => 'Used iphone',
				'price' => '500',
				'min_price' => '400',
				'max_price' => '2000',
				'end_date' => '2020-12-04 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Skateboard 2',
				'description' => 'Used skateboard 2',
				'price' => '200',
				'min_price' => '50',
				'max_price' => '500',
				'end_date' => '2020-12-05 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Mouse',
				'description' => 'Used mouse',
				'price' => '20',
				'min_price' => '5',
				'max_price' => '50',
				'end_date' => '2020-12-06 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Keyboard 2',
				'description' => 'Used keyboard 2',
				'price' => '50',
				'min_price' => '10',
				'max_price' => '100',
				'end_date' => '2020-12-07 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Iphone 12',
				'description' => 'Used iphone',
				'price' => '1500',
				'min_price' => '1000',
				'max_price' => '3000',
				'end_date' => '2020-12-08 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'PS5',
				'description' => 'Used PS5',
				'price' => '1500',
				'min_price' => '1000',
				'max_price' => '2500',
				'end_date' => '2020-12-09 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Monitor',
				'description' => 'Used monitor',
				'price' => '400',
				'min_price' => '100',
				'max_price' => '1500',
				'end_date' => '2020-12-10 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Keyboard 3',
				'description' => 'Used keyboard 3',
				'price' => '50',
				'min_price' => '10',
				'max_price' => '100',
				'end_date' => '2020-12-11 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Samsung galaxy 9',
				'description' => 'Used phone',
				'price' => '500',
				'min_price' => '400',
				'max_price' => '2000',
				'end_date' => '2020-12-12 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Bike',
				'description' => 'Used bike',
				'price' => '200',
				'min_price' => '50',
				'max_price' => '500',
				'end_date' => '2020-12-13 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Monitor 2 ',
				'description' => 'Used monitor 2',
				'price' => '400',
				'min_price' => '100',
				'max_price' => '1500',
				'end_date' => '2020-12-14 00:00:00',
				'status' => '1',
			]);

			DB::table('auction_items')->insert([
				'title' => 'Keyboard 4',
				'description' => 'Used keyboard 4',
				'price' => '50',
				'min_price' => '10',
				'max_price' => '100',
				'end_date' => '2020-12-15 00:00:00',
				'status' => '1',
			]);

		}
	}
