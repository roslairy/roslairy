<?php

use Illuminate\Database\Seeder;
use App\Archive;
use App\Utils;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	$category = Utils::CATEGORY;
        foreach (range(0, 29) as $i){
        	$archive = new Archive();
        	$archive->title = str_random(8);
        	$archive->category = $category[rand(0, 3)];
        	$archive->view = rand(0, 999);
        	$archive->like = rand(0, 999);
        	$archive->content = str_random(8).' '.str_random(8);
        	$archive->save();
        }
    }
}
