<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $response = Http::withHeaders([
            'Accept' => "application/json",
            'Content-type' => "application/json"
        ])->post(sprintf("https://github.com/login/oauth/access_token?client_id=%s&client_secret=%s&code=%s&redirect_uri=%s",
                env('GITHUB_APP_CLIENT_ID'), 
                env('GITHUB_APP_CLIENT_SECRET'), 
                $request->query('code'), 
                env('GITHUB_APP_REDIRECT_URI')
        ));

        $tokens = $response->json();
        Session::put('tokens', $tokens);

        return redirect()->route('gist.list');
    }

    public function tokens(){
        $tokens = Session::get("tokens");
        return response()->json($tokens);
    }

}
