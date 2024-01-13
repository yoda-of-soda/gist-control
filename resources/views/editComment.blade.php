<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/gist.css"/>
    <title>Edit comment</title>
</head>
<body>
    <div class="page-content">
        <h3 class="white">Edit comment ({{$comment['id']}})</h3>
        <form method="POST" action="/gists/{{$gistId}}/comments/{{$comment['id']}}">
            @csrf
            @method("PUT")
            <div id="comment-{{$comment['id']}}" class="comment">
                <div style="display: flex;">
                    <h5 style="flex: 4;">
                        {{$comment['user']['login']}}&nbsp;commented&nbsp;{{$comment['created_at']}}
                    </h5>
                </div>
                <textarea id="comment" name="comment" class="text-area">
                    {{$comment['body']}}
                </textarea>
            </div>
            <button class="button blue" type="submit">Edit comment</button>
        </form>
    </div>
</body>
</html>