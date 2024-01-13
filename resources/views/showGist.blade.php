<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/gist.css"/>
    <title>Gist: {{$description}}</title>
</head>
<body>
    <div class="page-content">
        <h3>
            {{$description}}&nbsp;(
                <a href="{{$html_url}}" target="_blank">
                    View on Github
                </a>)
        </h3>
        @foreach ($files as $file)
            <hr/>
            <strong>
                {{$file['filename']}}:
            </strong>
            <p>
                {{$file['content']}}
                @if ($file['truncated'])
                    ...
                @endif
            </p>
        @endforeach
        <hr/>
        <h4>
            Comments
        </h4>
        @foreach ($comments as $comment)
            <div id="comment-{{$comment['id']}}" class="comment">
                <div style="display: flex;">
                    <h5 style="flex: 4;">
                        {{$comment['user']['login']}}&nbsp;commented&nbsp;{{$comment['created_at']}}
                    </h5>
                        <button class="button white" style="flex: 1;"
                        onclick="window.location.pathname = '/gists/{{$id}}/comments/{{$comment['id']}}'">Edit</button>
                    <form method="POST" action="/gists/{{$id}}/comments/{{$comment['id']}}">
                        @csrf
                        @method('delete')
                        <button class="button white" style="flex: 1;">Delete</button>
                    </form>
                </div>
                <p>
                    {{$comment['body']}}
                </p>
            </div>
        @endforeach
        <div id="new-comment-container" class="comment">
            <form method="POST" action="/gists/{{$id}}/comments">
                @csrf
                <div>
                    <label for="new-comment">
                        Write a comment
                    </label>
                </div>
            <textarea id="new-comment" name="new-comment" class="text-area" rows="2" placeholder="Your comment"></textarea>
            <button type="submit" class="button white">Comment</button>
            </form>
        </div>
        <div style="display: flex;">
            <button type="button" class="button blue" style="flex: 1;" onclick="window.location.pathname = '/gists/{{$id}}/edit'">Edit</button>
            <form method="POST" action="/gists/{{$id}}/delete">
                @csrf
                <button type="submit" class="button red" style="flex: 1;">Delete</button>
            </form>
        </div>
    </div>
</body>
</html>