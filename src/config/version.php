<?php

return [

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

        'expose' => 'semver',

        // Middleware to use on the route
        'middleware' => 'web',

        // Name of route
        'name' => 'version',

        // URI to reach the version
        'uri' => '/version',

    ],

];
