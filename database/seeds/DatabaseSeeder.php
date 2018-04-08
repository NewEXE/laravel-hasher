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
        $this->call(HashAlgorithmsSeeder::class);
        $this->call(VocabularyTableSeeder::class);
    }
}
