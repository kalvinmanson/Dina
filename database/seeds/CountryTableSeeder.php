<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'name' => 'Colombia',
            'code' => 'co',
            'domain' => 'localhost',
            'configs' => '{}',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
