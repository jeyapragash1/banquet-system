<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Class Namespace
    |---------------------------------------------------------------------------
    |
    | This value sets the root class namespace for all of your Livewire
    | components. Be sure to update this value if you move your components to
    | a different namespace. (This is the default namespace)
    |
    */

    'class_namespace' => 'App\\Livewire',

    /*
    |---------------------------------------------------------------------------
    | View Path
    |---------------------------------------------------------------------------
    |
    | This value sets the path to your Livewire component views. This is
    | the default path when using the standard directory structure.
    |
    */

    'view_path' => resource_path('views/livewire'),

    /*
    |---------------------------------------------------------------------------
    | Layout
    |---------------------------------------------------------------------------
    |
    | This value sets the path to the layout file that will be used
    | when rendering full-page components.
    |
    */

    'layout' => 'resources/views/components/layout.blade.php',

    /*
    |---------------------------------------------------------------------------
    | Lazy Loading
    |---------------------------------------------------------------------------
    |
    | This value determines if Livewire components should be lazy loaded.
    | It is recommended to keep this enabled to improve performance.
    |
    */

    'lazy_loading' => true,

    /*
    |---------------------------------------------------------------------------
    | Temporary File Uploads
    |---------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing temporary files in a disk.
    | By default, this is the local disk, but you can change it.
    |
    */

    'temporary_file_upload' => [
        'disk' => null,
        'rules' => null,
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5,
    ],

    /*
    |---------------------------------------------------------------------------
    | Render On Redirect
    |---------------------------------------------------------------------------
    |
    | This value determines if Livewire will render a component on redirect.
    | It is recommended to keep this enabled to improve performance.
    |
    */

    'render_on_redirect' => true,

    /*
    |---------------------------------------------------------------------------
    | Eloquent Model Binding
    |---------------------------------------------------------------------------
    |
    | This value determines if Livewire will bind models directly to component
    | properties. It is recommended to keep this enabled.
    |
    */

    'legacy_model_binding' => false,

    /*
    |---------------------------------------------------------------------------
    | JavaScript Path
    |---------------------------------------------------------------------------
    |
    | This value sets the path to the Livewire JavaScript file.
    |
    */

    'inject_assets' => true,

    /*
    |---------------------------------------------------------------------------
    | GZip
    |---------------------------------------------------------------------------
    |
    | This value determines if Livewire will gzip the JavaScript assets.
    |
    */

    'navigate' => [
        'show_progress_bar' => true,
        'progress_bar_color' => '#2299dd',
    ],

    'inject_morph_markers' => true,

    'inject_server_sends' => false,

];