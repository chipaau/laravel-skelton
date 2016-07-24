<?php

use App\Schemas\UserSchema;
use App\Schemas\RoleSchema;
use Neomerx\Limoncello\Settings\Settings as S;

return [

    /*
    |--------------------------------------------------------------------------
    | A list of schemas
    |--------------------------------------------------------------------------
    |
    | Here you can specify what schemas should be used for object on encoding
    | to JSON API format.
    |
    */
    S::SCHEMAS => [
        UserSchema::class,
        RoleSchema::class
    ],

    /*
    |--------------------------------------------------------------------------
    | JSON encoding options
    |--------------------------------------------------------------------------
    |
    | Here you can specify options to be used while converting data to actual
    | JSON representation with json_encode function.
    |
    | For example if options are set to JSON_PRETTY_PRINT then returned data
    | will be nicely formatted with spaces.
    |
    | see http://php.net/manual/en/function.json-encode.php
    |
    | If this section is omitted default values will be used.
    |
    */
    S::JSON => [
        S::JSON_OPTIONS         => JSON_PRETTY_PRINT,
        S::JSON_DEPTH           => S::JSON_DEPTH_DEFAULT,
        S::JSON_IS_SHOW_VERSION => !S::JSON_IS_SHOW_VERSION_DEFAULT,
        S::JSON_URL_PREFIX      => null,
        S::JSON_VERSION_META    => [
            'name'  =>  'Chipaau Skelton Application',
            'copyright'  => '2016 chipaau@gmail.com',
            'powered-by' => 'Neomerx limoncello',
        ],
    ],

    S::AUTH => [
        S::AUTH_CODEC => null, // App\TokenCodec::class
    ],

];
