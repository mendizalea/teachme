<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->truncateTables(array(
			'users',
			'password_resets',
			'tickets',
			'ticket_votes',
			'ticket_comments'
		));

		$this->call('UserTableSeeder');
	}

	private function truncateTables(array $tables)
	{
		$this->checkForeignkeys(false);

		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}

		$this->checkForeignkeys(true);
	}

	private function checkForeignkeys($check)
	{
		$check = $check ? '1' : '0';
		DB::statement("SET FOREIGN_KEY_CHECKS = $check;");
	}

}
