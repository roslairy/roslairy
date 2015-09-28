<?php
use Illuminate\Database\Seeder;
use App\Archive;
use App\Comment;
class CommentSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$archives = Archive::all();
		$count = $archives->count();
		
		foreach ( range ( 0, 299 ) as $i ) {
			$comment = new Comment ();
			$comment->nickname = str_random ( 4 );
			$comment->archive_id = rand(1, $count);
			$comment->content = str_random ( 8 ) . ' ' . str_random ( 8 );
			$comment->save ();
		}
	}
}
