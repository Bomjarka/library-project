<?php

namespace App\Console\Commands;

use App\Models\Material;
use App\Models\Type;
use Illuminate\Console\Command;

class TestComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $material = Material::first();
        dd($material->type);
        return 0;
    }
}
