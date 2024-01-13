<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class GistService
{
    private $gistsBaseUrl;
    private $acceptHeader;
    
    public function __construct(){
        $this->gistsBaseUrl = 'https://api.github.com/gists';
        $this->acceptHeader = 'application/vnd.github+json';
    }

    private function newRequest(){
        $tokens = Session::get('tokens');
        $accessToken = $tokens["access_token"];

        return Http::withHeaders([
            'Accept' => $this->acceptHeader,
            'Content-type' => $this->acceptHeader,
            'Authorization' => 'Bearer ' . $accessToken
        ]);
    }

    public function getList(){
        $response = $this->newRequest()->get($this->gistsBaseUrl);

        return $response->json();
    }

    public function getGist($gistId){
        $response = $this->newRequest()->get($this->gistsBaseUrl . '/' . $gistId);
        return $response->json();
    }
    
    public function createGist($requestBody){
        $response = $this->newRequest()->post($this->gistsBaseUrl, $requestBody);
        
        return $response->json();
    }
    
    public function updateGist($gistId, $requestBody){
        $response = $this->newRequest()->patch($this->gistsBaseUrl . '/' . $gistId, $requestBody);
        
        return $response->json();
    }
    
    public function deleteGist($gistId){
        $response = $this->newRequest()->delete($this->gistsBaseUrl . '/' . $gistId);
        
        return $response->json();
    }

    public function getGistComments($gistId){
        $response = $this->newRequest()->get($this->gistsBaseUrl . '/' . $gistId . '/comments');
    
        return $response->json();
    }

    public function getGistComment($gistId, $commentId){
        $response = $this->newRequest()->get($this->gistsBaseUrl . '/' . $gistId . '/comments/' . $commentId);
    
        return $response->json();
    }

    public function createGistComment($gistId, $comment){
        $response = $this->newRequest()->post($this->gistsBaseUrl . '/' . $gistId . '/comments', [
            "body" => $comment
        ]);
    
        return $response->json();
    }

    public function updateGistComment($gistId, $commentId, $comment){
        $response = $this->newRequest()->patch($this->gistsBaseUrl . '/' . $gistId . '/comments/' . $commentId, [
            "body" => $comment
        ]);
    }

    public function deleteGistComment($gistId, $commentId){
        $response = $this->newRequest()->delete($this->gistsBaseUrl . '/' . $gistId . "/comments/" . $commentId);
    
        return $response->json();
    }
}