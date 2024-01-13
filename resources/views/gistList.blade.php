<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width='device-width', initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href ="/gist.css"/>
    <title>Gist list</title>
</head>
<body>
    <div class="page-content">
    <button class="button blue" onclick="window.location.pathname='/gists/new'">Create gist</button>
    @foreach ($gists as $gist)
    <div class="box" style="text-align: center;">
        <a href="/gists/{{$gist['id']}}">
            <h3 style="text-align: center;">{{$gist['description']}}</h3>
        </a>
        <a href="{{$gist['html_url']}}" target="_blank">View on Github</a>
        <div style="display: flex; align-items: center; justify-content: center;">
            <span>Written by &nbsp;</span>
            <a href="{{$gist['owner']['html_url']}}" target="_blank" style="color:#fff; text-decoration:none;">
                <span>{{$gist['owner']['login']}}</span>
                <img src="{{$gist['owner']['avatar_url']}}" height="15" width="15" style="border-radius: 50%;"/>
            </a>
        </div>
        <div>
            Created: {{$gist['created_at']}}
        </div>
        <div>
            Updated: {{$gist['updated_at']}}
        </div>
        <div>
            Number of files: {{count($gist['files'])}}
        </div>
        @if ($gist['public'])
            <div>Availability: Public</div>
        @else
            <div>Availability: Private</div>
        @endif
        <div>
            Comments:&nbsp;{{$gist['comments']}}
        </div>
    </div>
    @endforeach
    </div>
</body>
</html>