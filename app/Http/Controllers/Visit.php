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
	public function index(){

		$archives = Archive::where("published", "=", 1)
			->orderBy("created_at", "desc")
			->paginate(4);

		$this->filterList($archives);

		$data = [
				"pageName" => "index",
				"archives" => $archives,
		];

		$this->dataFilter($data);

		return view("index", $data);

	}

	public function sharpen(){
		return $this->getCategoryView('sharpen');
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

		$this->dataFilter($data);

		return view('index', $data);
	}

	public function archive($id){
		$archive = Archive::find($id);
		if ($archive == null)
			return redirect()->route('error', ['error' => 'archive-not-exist']);

		$archive->view++;
		$archive->save();

		$this->filterArchive($archive);

		$data = [
				'pageName' => 'archive',
				'archive' => $archive
		];

		$this->dataFilter($data);

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

// 	public function tryMind(){
// 		$pass = Input::get('mind-pass', '');

// 		if ($pass == env('MIND_PASS')){
// 			Session::put('mindPermission', 'true');
// 		}
// 		else {
// 			return redirect()->route('error', ['error' => 'bad-mind-pass']);
// 		}

// 		return redirect()->route('archive', ['id' => Input::get('id', 1)]);
// 	}

	public function error(){
		$error = Input::get('error', "unknown-error");
		return response()->view(
				'error',
				['pageName' => 'error', 'error' => trans('message.'.$error)],
				400
			);
	}

	protected function getCategoryView($category){
		$archives = Archive::where('category', '=', $category)
			->where("published", "=", 1)
			->orderBy("created_at", "desc")
			->paginate(6);
		$this->filterList($archives);

		$data = [
				'pageName' => $category,
				'category' => $category,
				'archives' => $archives
		];

		$this->dataFilter($data);

		return view('category', $data);
	}

	protected function filterList(&$archives){
		$authed = Auth::check();

		$i = -1;
		while((++$i) < count($archives)){
			if (!$authed && $archives[$i]->category == "mind"){
				$archives[$i]->content = "*****已加密*****";
			}
			else {
				$content = $archives[$i]->content;
				$content = strip_tags($content);
				$content = mb_substr($content, 0, 80);
				$content .= " ...";
				$archives[$i]->content = $content;
			}
		}
	}

	protected function filterArchive($archive){
		$authed = Auth::check();

		if (!$authed && $archive->category == "mind"){
			$archive->content =
				'<h4 class="text-center">*****已加密,查看朔心内容需登录*****</h4>';
		}
	}

	protected function dataFilter(&$data){
		$data["authed"] = Auth::check();
	}
}
