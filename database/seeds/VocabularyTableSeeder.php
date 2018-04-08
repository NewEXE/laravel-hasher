<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Vocabulary;

class VocabularyTableSeeder extends Seeder
{
    private $maxWordsCount = 50;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable(Vocabulary::getTableName()) && Vocabulary::count() < $this->maxWordsCount)
        {
            $faker = \Faker\Factory::create();

            for ($i = 0; $i < 50; $i++)
            {
                Vocabulary::firstOrCreate(['word' => $faker->word]);
            }
        }
    }
}
