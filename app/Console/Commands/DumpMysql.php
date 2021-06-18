<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DumpMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump:mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump and upload database on google cloud storage';

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
        \Spatie\DbDumper\Databases\MySql::create()
        ->setDbName(env('DB_DATABASE'))->setUserName(env('DB_USERNAME'))
        ->setPassword(env('DB_PASSWORD'))
        ->dumpToFile(env('APP_ROUTE','').'storage/dump_db/dump_'.date('Y-m-d').'.sql');

        \Log::info("Base de datos creada...".date('Y-m-d'));
        
        $disk = \Storage::disk('gcs');
        $disk->put("DB_help_desk_alis_foods.sql",\File::get(storage_path('dump_db/dump_'.date('Y-m-d').'.sql')));

        \App\BinnacleImage::where('image',null)->delete();

        \Log::info("Base de datos almacenada...");
        

    }
}
