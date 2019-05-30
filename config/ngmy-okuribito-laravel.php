<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Monitoring Views
    |--------------------------------------------------------------------------
    |
    | This value is views to monitor for loading. This value is specified in
    | the same format as the first argument of Laravel's View::composer method.
    |
    */

    'monitor_views' => null,

    /*
    |--------------------------------------------------------------------------
    | Exclude Files
    |--------------------------------------------------------------------------
    |
    | The file paths listed here are excluded from being recorded.
    |
    */

    'exclude_files' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Record Once
    |--------------------------------------------------------------------------
    |
    | By setting this option to true, the same view load is recorded only once.
    |
    */

    'record_once' => false,

    /*
    |--------------------------------------------------------------------------
    | Ignore Exception
    |--------------------------------------------------------------------------
    |
    | By setting this option to true, all exceptions are ignored.
    |
    | For a production environment, we strongly recommend setting to ture.
    |
    */

    'ignore_exception' => true,

];
