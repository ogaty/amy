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
        $faker = Faker\Factory::create('en_US');
        DB::connection('amy_testing')->table('users')->delete();
        DB::connection('amy_testing')->table('users')->insert([
            'id' => 1,
            'name' => $faker->lastName(),
            'email' => $faker->email(),
            'password' => $faker->password(),
            'remember_token' => str_random(10),
            'api_token' => str_random(10),
            'created_at' => '2017-05-01 10:00:00',
            'updated_at' => '2017-05-01 10:00:00',
        ]);
        DB::connection('amy_testing')->table('tasks')->delete();
        DB::connection('amy_testing')->table('categories')->delete();
        DB::connection('amy_testing')->table('tasks')->insert([
            'id' => 1,
            'name' => str_random(10),
            'list_id' => 1,
            'completed' => 0,
            'created_at' => '2017-05-01 10:00:00',
            'updated_at' => '2017-05-01 10:00:00',
        ]);
        DB::connection('amy_testing')->table('categories')->insert([
            'id' => 1,
            'name' => 'INBOX',
            'created_at' => '2017-05-01 10:00:00',
            'updated_at' => '2017-05-01 10:00:00',
        ]);
        DB::connection('amy_testing')->table('comments')->insert([
            'id' => 1,
            'task_id' => 1,
            'user_id' => 1,
            'comment' => $faker->sentence(),
            'created_at' => '2017-05-01 10:00:00',
            'updated_at' => '2017-05-01 10:00:00',
        ]);
    }
}
