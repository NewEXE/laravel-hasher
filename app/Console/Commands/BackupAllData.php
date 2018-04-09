<?php

namespace App\Console\Commands;

use File;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\ArrayToXml\ArrayToXml;

class BackupAllData extends Command
{
    /**
     * @var string
     */
    const UPLOAD_FOLDER = 'backups';

    /**
     * @var string
     */
    const FILENAME_DATE_FORMAT = 'Y-m-d_H-i-s';

    /**
     * @var string
     */
    const FILENAME_FORMAT = 'xml';

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
        $data = User::with(['hashes.word:id,word', 'hashes.algorithm:id,name', 'hashes.word.similar'])->get()->keyBy(function ($item) {
            return 'user_' . $item['id'];
        })->toArray();

        $xmlData = ArrayToXml::convert($data);

        $this->_preparePath();

        File::put($this->_getBackupsPath() . date(self::FILENAME_DATE_FORMAT) . '.' . self::FILENAME_FORMAT, $xmlData);
    }

    /**
     * @return bool
     */
    private function _preparePath()
    {
        return File::makeDirectory($this->_getBackupsPath(), 0755, true, true);
    }

    /**
     * @return string
     */
    private function _getBackupsPath()
    {
        return resource_path(self::UPLOAD_FOLDER) . '/';
    }
}
