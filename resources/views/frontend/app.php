<?php
$content = '<!doctype html> <html lang="en">';

$content .= require_once VIEWS . "{$this->permission}components/head.php";
$content .= $this->javascript;
$content .= '<body>';
$content .= '<div class="container-fluid p-0">';
$content .= require_once VIEWS . "{$this->permission}components/header.php";

if (file_exists(VIEWS . "{$this->permission}pages/{$this->file}.php")) {
    $content .= require_once VIEWS . "{$this->permission}pages/{$this->file}.php";
} else {
    $content .= '<h2>' . $this->file . ' view not fount</h2>';
}
$content .= require_once VIEWS . "{$this->permission}components/footer.php";
$content .= '</duv> <div id="basic-demo" class="example_content">I\'m a Basic PopupWindow!</div>';
$content .= '</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>';
$content .= '</html>';
return htmlentities($content);
