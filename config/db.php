<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=bake',
    'username' => 'laravel',
    'password' => 'redhat',
    'charset' => 'utf8',

    //Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
