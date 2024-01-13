<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <div class="page-content">
        <form method="POST" action="{{route('login.login')}}">
            @csrf
            @method("POST")
            <div>
                <a href="{{'http://www.github.com/login/oauth/authorize?client_id=' . env('GITHUB_APP_CLIENT_ID')}}">
                    <img src="/GithubSignIn.jpg" style="display: block; margin: auto;" width="50%"/>
                </a>
            </div>
        </form>
    </div>
</body>
</html>