<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Services\GistService;

class GistController extends Controller
{
    protected $gistService;
    
    public function __construct(GistService $_gistService){
        $this->gistService = $_gistService;
    }

    public function index(){
        $gists = $this->gistService->getList();
        
        return view('gistList', ["gists" => $gists]);
    }

    public function show($gistId){
        $gist = $this->gistService->getGist($gistId);
        $gist['comments'] = $this->gistService->getGistComments($gistId);
        return view("showGist", $gist);
    }

    public function create(){
        return view('createGist');
    }

    public function edit($gistId){
        $gist = $this->gistService->getGist($gistId);
        return view("editGist", $gist);
    }

    public function update(Request $request, $gistId){
        $params = [
            "description" => $request["description"],
            "public" => isset($request["public"])
        ];
        
        for($i = 0; $i < count($request["file-names"]); $i++) {
            $params['files'][$request['file-names'][$i]] = ["content" => $request['file-contents'][$i]];
        }

        $response = $this->gistService->updateGist($gistId, $params);
        
        if(isset($response['message'])){
            dd($response);
            return;
        }

        return redirect()->route('gist.show', $gistId);
    }

    public function store(Request $request){
        $params = [
            "description" => $request["description"],
            "public" => isset($request["public"])
        ];
        
        for($i = 0; $i < count($request["file-names"]); $i++) {
            $params['files'][$request['file-names'][$i]] = ["content" => $request['file-contents'][$i]];
        }
        
        $response = $this->gistService->createGist($params);
        if(isset($response['message'])){
            dd($response);
            return;
        } 
        return redirect()->route('gist.list');
    }

    public function delete($gistId){
        $response = $this->gistService->deleteGist($gistId);

        return redirect()->route('gist.list');
    }

    public function createComment(Request $request, $gistId){
        $response = $this->gistService->createGistComment($gistId, $request['new-comment']);
        if(isset($response['errors'])){
            dd($response);
            return;
        }
        return redirect()->route('gist.show', $gistId);
    }

    public function editComment($gistId, $commentId){
        $comment = $this->gistService->getGistComment($gistId, $commentId);
        return view('editComment', ["gistId" => $gistId, "comment" => $comment]);
    }

    public function updateComment(Request $request, $gistId, $commentId){
        $response = $this->gistService->updateGistComment($gistId, $commentId, $request['comment']);
        if(isset($response['errors'])){
            dd($response);
            return;
        }
        return redirect()->route('gist.show', $gistId);
    }

    public function deleteComment($gistId, $commentId){
        $response = $this->gistService->deleteGistComment($gistId, $commentId);
        if(isset($response['errors'])){
            dd($response);
            return;
        }
        return redirect()->route('gist.show', $gistId);
    }
}
