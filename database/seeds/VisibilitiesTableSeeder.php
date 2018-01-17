<?php

use Illuminate\Database\Seeder;

class VisibilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visibilities')->insert([
            [
                'id' => 1,
                'name' => 'Private',
            ],
            [
                'id' => 2,
                'name' => 'Public',
            ],
        ]);
    }
}
