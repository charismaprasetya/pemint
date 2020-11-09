<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'username' => 'charisma',
            'password' => '123456',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // $this->call('UsersTableSeeder');
    }
}
