<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\HashAlgorithm;
use App\Facades\HMACHasher;

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
            $algos = HMACHasher::getAllAvailableAlgos(false);

            foreach ($algos as $algo)
            {
                HashAlgorithm::firstOrCreate(['name' => $algo]);
            }

        }
    }
}
