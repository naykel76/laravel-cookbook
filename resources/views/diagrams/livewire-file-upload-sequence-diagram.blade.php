<h2>Livewire temporary upload sequence diagram</h2>

<div class="container-md-start mb-2">

    <p>The diagram illustrates the process of uploading a file with FilePond, covering the steps of selecting a file,
        validating it, storing it temporarily, and deciding whether to permanently store or delete it.</p>
    <ol>
        <li>The user selects a file, which triggers Livewire.</li>
        <li>Livewire requests a signed upload URL from the server.</li>
        <li>The server returns the signed upload URL to Livewire.</li>
        <li>Livewire uploads the file(s) to the signed URL.</li>
        <li>The server returns a unique hash ID to Livewire.</li>
        <li>Livewire sets a public property to an instance of TemporaryUploadedFile.</li>
    </ol>
    <p class="fw6 txt-balance">When the sequence is complete, a <code>TemporaryUploadedFile</code> instance will be assigned to the public image property of the Livewire component.</p>
</div>

<x-mermaid>
    sequenceDiagram
    actor User
    participant Livewire
    participant Server
    participant LivewireComponent
    User->>Livewire: Select file (file)
    activate Livewire
    Livewire->>Server: Request signed upload URL (file)
    activate Server
    Server-->>Livewire: Return signed upload URL (signedURL)
    Livewire->>Server: Upload file(s) to signed URL (file, signedURL)
    Server-->>Livewire: Return unique hash ID (hashID)
    deactivate Server
    Livewire->>LivewireComponent: Set public property to `TemporaryUploadedFile` instance
    deactivate Livewire
</x-mermaid>
