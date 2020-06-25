<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            'title' => 'test title 1',
            'content' => 'test content 1'
        ]);
        DB::table('messages')->insert([
            'title' => 'test title 2',
            'content' => 'test content 2'
        ]);
        DB::table('messages')->insert([
            'title' => 'test title 3',
            'content' => 'test content 3'
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
