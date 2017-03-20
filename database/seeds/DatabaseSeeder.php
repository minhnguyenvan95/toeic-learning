<?php

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
        $this->call(UsersSeeder::class);
        $this->call(QuestionTypeSeeder::class);
        //$this->call(QuestionSeeder::class);
        //$this->call(AnswerSeeder::class);
        $this->call(PostSeeder::class);
    }
}
