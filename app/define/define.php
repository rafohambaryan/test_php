<?php
define('ROOT', "{$_SERVER['DOCUMENT_ROOT']}/");
define('MODEL', "{$_SERVER['DOCUMENT_ROOT']}/app/Models/");
define('PHP', ".php");
define('VIEWS', ROOT . 'resources/views/');
define('CONTROLLER', "{$_SERVER['DOCUMENT_ROOT']}/app/controllers/");
define('PUBLIC_PATH', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/");
define('ORIGIN', PUBLIC_PATH);
define('URL', "{$_SERVER['REQUEST_URI']}");
define('METHOD', "{$_SERVER['REQUEST_METHOD']}");