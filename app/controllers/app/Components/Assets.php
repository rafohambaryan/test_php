<?php


namespace app\controllers\app\Components;


trait Assets
{
    private function asset($url)
    {
        $url = trim($url, '/');
        return $this->public . $url;
    }

    private function css($url)
    {
        $url = trim($url, '/');
        if (file_exists(ROOT . "public/{$this->permission}{$url}")) {
            return <<<HTML
                        <link rel="stylesheet" href="$this->public$url" type="text/css">
                      HTML;
        }
        return $this->not_fount($this->public . $url, 'css');
    }

    private function js($url)
    {
        $url = trim($url, '/');
        if (file_exists(ROOT . "public/{$this->permission}{$url}")) {
            return <<<HTML
                        <script src="$this->public$url" type="text/javascript"></script>
                      HTML;
        }
        return $this->not_fount($this->public . $url, 'js');

    }

    private function not_fount($url, $ext)
    {
        return <<<HTML
                     <script type="text/javascript">
                         console.error('error 404 $ext file not fount: $url')
                     </script>
                  HTML;
    }

}