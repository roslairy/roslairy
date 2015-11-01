<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Archive;
use App\Comment;
use App\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Facades\Log;

class Admin extends Controller {
	
	public function tryLogin(){
		$username = Input::get('username', '');
		$password = Input::get('password', '');
		
		if (Auth::attempt(['email' => $username, 'password' => $password])){
			Session::put('login', 'true');
			return redirect()->route('archive-manage');
		}
		
		return redirect()->route('error', ['error' => 'bad-login-pass']);
	}
	
	public function tryLogout(){
		Session::forget('login');
		Auth::logout();
		return redirect()->route('index');
	}
	
	public function archive(){
		$data = [
				'pageName' => 'archive-manage',
				'archives' => Archive::getAll(15)
		];
		
		return view('admin-archive', $data);
	}
	
	public function archiveEdit($id){
		$archive = Archive::find($id);
		if ($archive == null) {
			return redirect()->route('error', ['error' => 'archive-not-exist']);
		}

		$data = [
				'pageName' => 'archive-edit',
				'archive' => $archive
		];
		
		return view('admin-edit', $data);
	}
	
	public function archiveNew(){
		$archive = new Archive();

		$archive->id = -1;
		$archive->title = '';
		$archive->category = '';
		$archive->content = '';
		
		$data = [
				'pageName' => 'archive-new',
				'superAuth' => Auth::user()->email == 'wpikuy',
				'archive' => $archive
		];
		
		return view('admin-edit', $data);
	}
	
	public function archiveDelete(){
		$archive = Archive::find(Input::get('id', -1));
		if ($archive == null) {
			return redirect()->route('error', ['error' => 'archive-not-exist']);
		}
		
		foreach ($archive->comments as $comment){
			$comment->delete();
		}
		$archive->delete();
		
		return redirect()->route('archive-manage');
	}
	
	public function archiveSave(){
		$v = Validator::make(Input::all(), [
				'title' => 'required',
				'category' => 'required',
				'content' => 'required',
		]);
		if ($v->fails()){
			return redirect()->route('error', ['error' => 'param-wrong']);
		}
		
		$archive = Archive::findOrNew(Input::get('id', -1));
		
		$archive->title = Input::get('title');
		$archive->category = Input::get('category');
		$archive->content = Input::get('content');
		$archive->save();
		
		if (Req::hasFile("picture")){
			$fileName = str_random(8).$archive->id.".jpg";
			$file = Req::file("picture");
			$file->move(public_path("uploadimg"), $fileName);
			$archive->picture = $fileName;
			$archive->save();
		}

		return redirect()->route('archive-manage');
	}
	
	public function archiveAjax(){
		$v = Validator::make(Input::all(), [
				'title' => 'required',
				'category' => 'required',
				'content' => 'required',
		]);
		if ($v->fails()){
			return response()->json(["message" => $v->messages()], 403);
		}
		
		$archive = Archive::findOrNew(Input::get('id', -1));
		
		$archive->title = Input::get('title');
		$archive->category = Input::get('category');
		$archive->content = Input::get('content');
		$archive->save();

		return response()->json(["id" => $archive->id]);
	}
	
	public function comment(){
		$data = [
				'pageName' => 'comment-manage',
				'superAuth' => Auth::user()->email == 'wpikuy',
				'comments' => Comment::getAll()
		];
		
		return view('admin-comment', $data);
	}
	
	public function commentDelete(){
		$comment = Comment::find(Input::get('id', -1));
		if ($comment == null) {
			return redirect()->route('error', ['error' => 'comment-not-exist']);
		}
		
		$comment->delete();

		return redirect()->route('comment-manage');
	}
	
// 	public function view(){
// 		$data = [
// 				'pageName' => 'view-manage',
// 				'superAuth' => Auth::user()->email == 'wpikuy',
// 				'views' => View::getAll()
// 		];
		
// 		return view('admin.view-manage', $data);
// 	}
	
// 	public function viewDelete(){
// 		$view = View::find(Input::get('id', -1));
// 		if ($view == null) {
// 			return redirect()->route('error', ['error' => 'view-not-exist']);
// 		}
		
// 		$view->delete();

// 		return redirect()->route('view-manage');
// 	}
	
}
