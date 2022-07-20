<?php

namespace App\Console\Commands;

use App\Models\Material;
use App\Models\MaterialTags;
use App\Models\Tag;
use App\Models\Type;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

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


    public function handle()
    {

       $material = Material::find(1);
       $tags = Tag::whereNotIn('id', $material->tags()->pluck('id'))->get();
       dd($tags);
    }
}
