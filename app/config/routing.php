<?php

return array(
    '/' => array(
        '/' => 'EntryController:index:home::get',
        '/hello/{name}' => 'HomeController:hello:nam:name=world',

        '/entrys' => 'EntryController:index',
        '/entrys/{page}' => 'EntryController:turnPage:entry:page=0',
        '/entry/{id}' => 'EntryController:single:singleEntry:id=0',

        '/login' => 'UserController:login',
        '/logout' => 'UserController:logout',
        '/register' => 'UserController:register',

        '/entrymanager/{page}' => 'EntryController:manage:entrymanage:page=0',
        '/entrymanage/create' => 'EntryController:create:createentry',
        '/entrymanage/update/{id}' => 'EntryController:update:updateentry:id=0',
        '/entrymanage/delete/{id}' => 'EntryController:delete:deleteentry:id=0'
    ),
    '/admin' => array(
        '/' => 'AdminController:index:adminIndex::get'
    )
);