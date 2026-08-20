<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the bcrypt algorithm is
    | used; however, you are free to change this option to any other.
    |
    */

    'driver' => 'bcrypt',

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options for when passwords are
    | hashed using the Bcrypt algorithm. This will allow you to control each
    | algorithm's settings based on your application's unique needs.
    |
    */

    'bcrypt' => [
        'rounds' => (int) env('BCRYPT_ROUNDS', 12),
        'verify' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options for when passwords are
    | hashed using the Argon algorithms. These options are used to modify
    | the memory, work, and time factors used when hashing passwords.
    |
    */

    'argon' => [
        'memory' => 65536,
        'threads' => 1,
        'time' => 4,
        'verify' => true,
    ],

];
