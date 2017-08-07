<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Connections
    |--------------------------------------------------------------------------
    |
    | This array stores the connections that are added to Adldap. You can add
    | as many connections as you like.
    |
    | The key is the name of the connection you wish to use and the value is
    | an array of configuration settings.
    |
    */

    'connections' => [

        'default' => [

            /*
            |--------------------------------------------------------------------------
            | Auto Connect
            |--------------------------------------------------------------------------
            |
            | If auto connect is true, Adldap will try to automatically connect to
            | your LDAP server in your configuration. This allows you to assume
            | connectivity rather than having to connect manually
            | in your application.
            |
            | If this is set to false, you must connect manually before running
            | LDAP operations.
            |
            */

            'auto_connect' => true,

            /*
            |--------------------------------------------------------------------------
            | Connection
            |--------------------------------------------------------------------------
            |
            | The connection class to use to run raw LDAP operations on.
            |
            | Custom connection classes must implement:
            |  \Adldap\Connections\ConnectionInterface
            |
            */

            'connection' => Adldap\Connections\Ldap::class,

            /*
            |--------------------------------------------------------------------------
            | Schema
            |--------------------------------------------------------------------------
            |
            | The schema class to use for retrieving attributes and generating models.
            |
            | You can also set this option to `null` to use the default schema class.
            |
            | Custom schema classes must implement \Adldap\Schemas\SchemaInterface
            |
            */

            'schema' => Adldap\Schemas\ActiveDirectory::class,

            /*
            |--------------------------------------------------------------------------
            | Connection Settings
            |--------------------------------------------------------------------------
            |
            | This connection settings array is directly passed into the Adldap constructor.
            |
            | Feel free to add or remove settings you don't need.
            |
            */

            'connection_settings' => [

                'account_prefix' => env('ADLDAP_ACCOUNT_PREFIX', ''),
                'account_suffix' => env('ADLDAP_ACCOUNT_SUFFIX', ''),
                'domain_controllers' => explode(' ', env('ADLDAP_CONTROLLERS', '172.20.12.120')),
                'port' => env('ADLDAP_PORT', 389),
                'timeout' => env('ADLDAP_TIMEOUT', 5),
                'base_dn' => env('ADLDAP_BASEDN', 'DC=smm,DC=com'),
                'admin_account_suffix' => env('ADLDAP_ADMIN_ACCOUNT_SUFFIX', ''),
                'admin_username' => env('ADLDAP_ADMIN_USERNAME', 'bitrix@sinarmasmining.com'),
                'admin_password' => env('ADLDAP_ADMIN_PASSWORD', 'SysDev2017'),
                'follow_referrals' => false,
                'use_ssl' => false,
                'use_tls' => false,

            ],[
                'account_prefix' => env('ADLDAP_ACCOUNT_PREFIX', ''),
                'account_suffix' => env('ADLDAP_ACCOUNT_SUFFIX', ''),
                'domain_controllers' => explode(' ', env('ADLDAP_CONTROLLERS', '10.10.13.8')),
                'port' => env('ADLDAP_PORT', 389),
                'timeout' => env('ADLDAP_TIMEOUT', 5),
                'base_dn' => env('ADLDAP_BASEDN', 'DC=beraucoal,DC=co,DC=id'),
                'admin_account_suffix' => env('ADLDAP_ADMIN_ACCOUNT_SUFFIX', ''),
                'admin_username' => env('ADLDAP_ADMIN_USERNAME', 'bitrix@beraucoal.co.id'),
                'admin_password' => env('ADLDAP_ADMIN_PASSWORD', 'P@ssw0rd123'),
                'follow_referrals' => false,
                'use_ssl' => false,
                'use_tls' => false,
            ],

        ],

    ],

];
