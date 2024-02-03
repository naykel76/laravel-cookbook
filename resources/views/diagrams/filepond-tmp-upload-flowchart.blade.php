<h2>FilePond Upload</h2>

<div class="container-md-start">
    <p>The diagram illustrates the process of uploading a file with FilePond, covering the steps of selecting a file, validating it, storing it temporarily, and deciding whether to permanently store or delete it.</p>
</div>

<x-mermaid>
    graph LR
    start([Select file to upload]) --> validate{File valid?}
    validate --> |Yes| valid[Upload file to server<br>tmp directory]
    validate --> |No| error[Show error message]
    error --> end1((End))
    valid --> tmp[Store file in tmp directory<br>and save details to session]
    tmp --> save[SAVE and move file<br> to storage directory]
    tmp --> cancel[CANCEL to delete file<br> from tmp directory]
    save --> end1((End))
    cancel --> end1((End))
</x-mermaid>
