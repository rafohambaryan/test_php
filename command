#!/usr/bin/php -q
<?php

class Command
{
    public function __construct($argv)
    {
        foreach ($argv as $index => $item) {
            if ($index === 0 && $item === 'command') {
                continue 1;
            } else if ($index === 1 && ($item === 'migrate:run' || $item === 'migrate:down')) {
                $this->migrate(end(explode(':', $item)));
            } else if ($index === 1 && $item === 'migrate:refresh') {
                $this->migrate('down');
                $this->migrate('run');
            } else {
                echo 'command not fount';
            }


        }
    }

    private function migrate($command)
    {
        foreach (glob(__DIR__ . '\\app\\database\\migrations\\*.php') as $item) {
            if (file_exists($item)) {
                require_once $item;
                $class = pathinfo($item, PATHINFO_FILENAME);
                new $class($command);


            }
        }

    }
}

spl_autoload_register(function ($class_name) {
    if (file_exists(__DIR__ . "/$class_name.php")) {
        require_once __DIR__ . "/{$class_name}.php";
    } else {
        echo "$class_name.php Class does not exist";
        die;
    }
});
new Command($argv);
exit (0);