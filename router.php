<?php

$routes['']['get'] = 'HomeController@index';
$routes['posts/$date/$slug']['get'] = 'HomeController@testing';