<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/gist.css"/>
    <title>Edit gist</title>
</head>
<body>
    <div class="page-content">
        <h3 class="white">Edit gist</h3>
        <form method="POST" action="/gists/{{$id}}">
            @csrf
            @method("PUT")
            <div>
                <label for="description">Title</label>
                <input id="description" name="description" value="{{$description}}"/>
            </div>
            <div>
                <label for="public">Public</label>
                <input type="checkbox" id="public" name="public" value="{{isset($public)}}"/>
            </div>
            <hr/>
            <div id="files-container">
                <label for="files">Files</label>
                @foreach ($files as $file)
                    <div style="display: flex;">
                        <span style="flex: 5;">
                            <label>File name</label>
                            <input name="file-names[]" value="{{$file['filename']}}"/>
                        </span>
                        <button id="{{$file['filename']}}" type="button" class="button white" style="margin: 0; padding: 5px 0; flex: 1;"
                        onclick="removeFileInput(this)">Remove</span>
                    </div>
                    <div style="margin-top:10px;">
                        <label style="display: block;">Content</label>
                        <textarea class="text-area" name="file-contents[]" rows="4">{{$file['content']}}</textarea>
                    </div>
                @endforeach
            </div>
            <div style="display: flex;">
                <button type="button" class="button blue" style="flex: 1;"
                onclick="addFileInput()">Add file</button>
                <button class="button blue" type="submit"
                style="flex: 1;">Edit gist</button>
            </div>
        </form>
    </div>
</body>
<script>
    function addFileInput(){
        const container = document.getElementById("files-container")
        const fileListItem = document.createElement("div")
        fileListItem.classList = "file-list-item box"
        const id = crypto.randomUUID()
        fileListItem.innerHTML = `<div style="display: flex;">
                        <span style="flex: 5;">
                            <label>File name</label>
                            <input name="file-names[]"/>
                        </span>
                        <button id="${id}" type="button" class="button white" style="margin: 0; padding: 5px 0; flex: 1;"
                        onclick="removeFileInput(this)">Remove</span>
                    </div>
                    <div style="margin-top:10px;">
                        <label style="display: block;">Content</label>
                        <textarea class="text-area" name="file-contents[]" rows="4"></textarea>
                    </div>`
        container.appendChild(fileListItem)
    }
    function removeFileInput(element){
        element.parentElement.parentElement.remove()
    }
</script>
</html>