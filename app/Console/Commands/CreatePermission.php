<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all routes name from web.php and store it into permissions table.';

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
     * @return int
     */
    public function handle()
    {

        return 0;
    }

    public function createModule($moduleName)
    {
        $moduleId = Module::updateOrCreate([
            'name' => str_replace('/', '', $moduleName),
            'slug' => Str::slug($moduleName),
        ]);

        return $moduleId->id;
    }

}
