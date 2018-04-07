<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\HashAlgorithm;

class HashAlgorithmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable(HashAlgorithm::getTableName()))
        {
            /** @var array $algos */
            $algos = hash_hmac_algos();

            foreach ($algos as $algo)
            {
                HashAlgorithm::firstOrCreate(['name' => $algo]);
            }

        }
    }
}
