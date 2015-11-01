<?php
namespace App;

use Illuminate\Support\Facades\App;
use Carbon\Carbon;
class SitemapMaker{
	public static function make(){
		
		$date = Carbon::now()->toDateTimeString();
		
		$sitemap = App::make("sitemap");
		
		$sitemap->add(route('index'), $date, "1.0", "daily");
		$sitemap->add(route('sharpen'), $date, "0.9", "daily");
		$sitemap->add(route('anecdote'), $date, "0.9", "daily");
		$sitemap->add(route('mind'), $date, "0.9", "daily");
		
		$archives = Archive::where("published", "=", 1)->get();
		
		foreach ($archives as $archive){
			$sitemap->add(
					route('archive', ['id' => $archive->id]), 
					$archive->updated_at, 
					"0.8", 
					"daily"
				);
		}

		$sitemap->store('xml', 'sitemap');
	}
}