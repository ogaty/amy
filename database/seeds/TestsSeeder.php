<?php

use Illuminate\Database\Seeder;

class TestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();
        DB::table('categories')->delete();
        DB::table('tasks')->insert([
            'id' => 1,
            'name' => str_random(10),
            'list_id' => 1,
            'completed' => 0,
            'created_at' => '2017-05-01 10:00:00',
            'updated_at' => '2017-05-01 10:00:00',
        ]);
        DB::table('categories')->insert([
            'id' => 1,
            'name' => str_random(10),
            'created_at' => '2017-05-01 10:00:00',
            'updated_at' => '2017-05-01 10:00:00',
        ]);
    }
}
