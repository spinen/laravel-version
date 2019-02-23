<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Version file
    |--------------------------------------------------------------------------
    |
    | The version file to read relative to the base path.
    */
    'file'  => 'VERSION',

    /*
    |--------------------------------------------------------------------------
    | Route configuration
    |--------------------------------------------------------------------------
    |
    | A route to show the application's version
    */
    'route' => [

        // Expose a route?
        'enabled' => true,

        // What to expose on the route. Possible values...
        //      * major
        //      * meta
        //      * minor
        //      * patch
        //      * pre_release
        //      * semver
        //      * version
        'expose'     => 'semver',

        // Middleware to use on the route
        'middleware' => 'web',

        // Name of route
        'name'       => 'version',

        // URI to reach the version
        'uri'        => '/version',

    ],

    /*
    |--------------------------------------------------------------------------
    | View composer configuration
    |--------------------------------------------------------------------------
    |
    | Attach an instance of the Version object to the view.
    */
    'view' => [

        // Add the view composer?
        'enabled' => true,

        // What to variable name to expose the version instance as
        'variable'     => 'version',

        // Views to attach. "*" (default), is all views.  You can pass an
        // array of views as well
        'views' => '*',

    ],

];
