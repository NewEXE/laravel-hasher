<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create xml files with information about user, their saved hashes, origin words and similar words from database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
