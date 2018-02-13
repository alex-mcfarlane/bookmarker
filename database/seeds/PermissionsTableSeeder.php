<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'Create',
            ],
            [
                'id' => 2,
                'name' => 'Read',
            ],
            [
                'id' => 3,
                'name' => 'Update',
            ],
            [
                'id' => 4,
                'name' => 'Delete',
            ]
        ]);
    }
}
