<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Archive;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\View;
use App\Comment;
use Illuminate\Support\Facades\Validator;

class Visit extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function all() {
		$data = [
				'pageName' => 'all',
				'archives' => Archive::getAll()
		];
		
		return view('index', $data);
	}
	
	public function sharpen(){
		return $this->getCategoryView('sharpen');
	}
	
	public function creation(){
		return $this->getCategoryView('creation');
	}
	
	public function anecdote(){
		return $this->getCategoryView('anecdote');
	}
	
	public function mind(){
		return $this->getCategoryView('mind');
	}
	
	public function search(){
		$searchStr = Input::get('search', '');
		$archives = Archive::where('title', 'like', "%{$searchStr}%")->paginate(5);
		$data = [
				'pageName' => 'search',
				'archives' => $archives
		];
		
		return view('index', $data);
	}
	
	public function archive($id){
		$archive = Archive::find($id);
		if ($archive == null) 
			return redirect()->route('error', ['error' => 'archive-not-exist']);
		
		if ($archive->category == trans('category.mind')){
			if (Session::get('mindPermission', 'false') != 'true'){
				return redirect()->route('error', ['error' => 'require-mind-pass']);
			}
		}
		
		$data = [
				'pageName' => 'archive',
				'archive' => $archive
		];
		
		return view('archive', $data);
	}
	
	public function sendComment(){
		$v = Validator::make(Input::all(), [
				'id' => 'required|numeric',
				'nickname' => 'required',
				'content' => 'required',
		]);
		if ($v->fails()){
			return redirect()->route('error', ['error' => 'param-wrong']);
		}
		
		$archive = Archive::find(Input::get('id'));
		if ($archive == null) {
			return redirect()->route('error', ['error' => 'archive-not-exist']);
		}
		
		$comment = new Comment();
		$comment->archive_id = Input::get('id');
		$comment->nickname = Input::get('nickname');
		$comment->content = Input::get('content');
		$comment->save();
		
		return redirect()->route('archive', ['id' => Input::get('id')]);
	}
	
	public function like(){
		$archive = Archive::find(Input::get('id', -1));
		if ($archive == null) {
			return redirect()->route('error', ['error' => 'archive-not-exist']);
		}
		
		$archive->like++;
		$archive->save();

		return redirect()->route('archive', ['id' => Input::get('id')]);
	}
	
	public function tryMind(){
		$pass = Input::get('mind-pass', '');
		
		if ($pass == env('MIND_PASS')){
			Session::put('mindPermission', 'true');
		}
		else {
			return redirect()->route('error', ['error' => 'bad-mind-pass']);
		}
		
		return redirect()->route('archive', ['id' => Input::get('id', 1)]);
	}
	
	public function error(){
		$error = Input::get('error');
		return view('error', ['pageName' => 'error', 'error' => trans('message.'.$error)]);
	}
	
	protected function getCategoryView($category){
		$data = [
				'pageName' => $category,
				'archives' => Archive::getWhereCategory(trans("category.$category"))
		];
		
		return view('index', $data);
	}
}
