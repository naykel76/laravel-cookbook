<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# Laravel Cookbook

Laravel cookbook site with a side of Livewire and a sprinkle of Alpine.

## Controller the resource methods

- [x] `index` - Display a listing of the resource. (paginated)
- [ ] `create` - Show the form for creating a new resource.
- [ ] `store` - Store a newly created resource in storage.
- [ ] `show` - Display the specified resource.
- [ ] `edit` - Show the form for editing the specified resource.
- [ ] `update` - Update the specified resource in storage.
- [x] `destroy` - Remove the specified resource from storage.

The `index` page is typically used to list all instances of a certain resource. For example, a
products page. In this case, the `index` page will be a paginated table more like what you would
expect in the admin area of a website.

## Model
- [ ] Define relationships
    - [ ] hasOne
    - [ ] hasMany
    - [ ] belongsTo
    - [ ] belongsToMany
- [ ] Query scope
- [ ] Attribute casting

## Form with all elements
- [ ] Text Input
- [ ] Number Input
- [ ] Date Input
- [ ] Textarea
- [ ] Select
- [ ] Radio
- [ ] Checkbox
- [ ] File
- [ ] Submit
- [ ] Validation
- [ ] Error messages
- [ ] Old input
- [ ] Form method spoofing
    - [ ] PUT
    - [ ] PATCH
    - [ ] DELETE

## Blade Components
- [ ] Filepond
- [ ] Ckeditor
- [ ] Notification
- [ ] Errors

## Middleware
- [ ] Define middleware for authentication/authorization if needed
- [ ] Apply middleware to routes or controller methods

## Authentication
- [ ] Register
- [ ] Login
- [ ] Logout
- [ ] Forgot password
- [ ] Reset password
- [ ] Email verification
- [ ] Two factor authentication

## Policies
- [ ] Define policies for authorization
- [ ] Apply policies to controller methods
- [ ] Apply policies to routes
- [ ] Apply policies to views



### Filepond upload sequence diagram

This diagram shows the sequence of events that occur when a file is uploaded using Filepond. The
diagram only shows the sequence of events from when a user has already selected a file and clicks
the upload button. It does not show the sequence of events that occur when a user selects a file.

```mermaid
sequenceDiagram
    participant view as <<View>>
    participant pond as Filepond
    participant server
    participant store as store()<br>UploadController
    participant destroy as destroy()<br>UploadController

    activate view
        view->>pond: Initiate file upload

        activate pond
            pond->>server: Upload file to server
        deactivate pond

        activate server
            server->>server: Validate and process file
            alt is valid?
                server->>store: store(request)
                activate store
                    store->>store: Check if request has file 'image'
                    alt request has 'image'
                        store->>store: Get file 'image' from request
                        store->>store: Get original file name
                        store->>store: Generate unique folder name
                        store->>store: Store file in "tmp/{$folder}" with original file name
                        store-->>server: Return file name
                    else request does not have 'image'
                        store-->>server: Return empty string
                    end
                deactivate store
            else is not valid?
                server-->>destroy: Delete file from server
                server-->>view: Show Error Message
            end
        deactivate server
    deactivate view
```

```mermaid
sequenceDiagram
    participant view as <<View>>
    participant pond as Filepond
    participant server
    participant tmpUpload as tmpUpload()<br>UploadController
    participant tmpDelete as tmpDelete()<br>UploadController

    activate view
        view->>pond: Initiate file upload

        activate pond
            pond->>pond: Validate and process file
            pond->>server: Upload file to server

        deactivate pond

        activate server
            server->>tmpUpload: tmpUpload(request)
            activate tmpUpload
                tmpUpload->>tmpUpload: Check if request has file 'image_filepond'
                alt request has 'image_filepond'
                    tmpUpload->>tmpUpload: Get file 'image_filepond' from request
                    tmpUpload->>tmpUpload: Generate unique directory name
                    tmpUpload->>tmpUpload: Store file in "tmp/{$directory}" with unique name
                    tmpUpload-->>server: Return file name
                else request does not have 'image_filepond'
                    tmpUpload-->>server: Return empty string
                end
            deactivate tmpUpload
        server->>tmpDelete: tmpDelete()
        activate tmpDelete
            tmpDelete->>tmpDelete: Delete file from server if exists
            tmpDelete-->>server: Return response
        deactivate tmpDelete
    deactivate server
deactivate view
```


### Filepond upload flowchart

This is a high level flowchart of the sequence of events that occur when a file is uploaded using
Filepond. The flowchart only shows the sequence of events from when a user has browsed for a File
and selected it. It does not show the sequence of events that occur when a user clicks the upload
button.


```mermaid
graph LR
    start([Select file to upload]) --> validate{File valid?}
    validate --> |Yes| valid[Upload file to server<br>tmp directory]
    validate --> |No| error[Show error message]
    error --> end1((End))
    valid --> tmp[Store file in tmp directory<br>and save details to session]
    tmp --> save[SAVE and move file<br> to storage directory]
    tmp --> cancel[CANCEL to delete file<br> from server tmp directory]
    save --> end1((End))
    cancel --> end1((End))
```

