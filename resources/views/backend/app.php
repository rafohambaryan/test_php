<?php
$content = '<!doctype html> <html lang="en">';

$content .= require_once VIEWS . "{$this->permission}components/head.php";
$content .= $this->javascript;
$content .= '<body>';
$content .= require_once VIEWS . "{$this->permission}components/header.php";

if (file_exists(VIEWS . "{$this->permission}pages/{$this->file}.php")) {
    $content .= require_once VIEWS . "{$this->permission}pages/{$this->file}.php";
} else {
    $content .= '<h2>' . $this->file . ' view not fount</h2>';
}
$content .= require_once VIEWS . "{$this->permission}components/footer.php";
$content .= '</body>';
$content .= '</html>';
return htmlentities($content);