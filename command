#!/usr/bin/php -q
<?php

class Command
{
    /**
     * @var string
     */
    private $sql = '';

    public function __construct($argv)
    {
        $error = 'command not fount';
        foreach ($argv as $index => $item) {
            if ($index === 0 && $item === 'command') {
                continue 1;
            } else if ($index === 1 && ($item === 'migrate:run' || $item === 'migrate:down') && !isset($argv[$index + 1])) {
                $this->migrate(end(@explode(':', $item)));
                goto stop;
            } else if ($index === 1 && $item === 'make:model' && isset($argv[$index + 1]) && !isset($argv[$index + 2])) {
                $model = $argv[$index + 1];
                if (file_exists(__DIR__ . '/app/Models/' . $model . '.php')) {
                    $error = "model [ $model ] exist";
                    break 1;
                }
                $this->createModelAndMigrate($model);
                goto stop;
            }


        }
        echo $error;
        stop:
    }

    /**
     * @param $command
     */
    private function migrate($command)
    {
        foreach (glob(__DIR__ . '\\app\\database\\migrations\\*.php') as $item) {
            if (file_exists($item)) {
                require_once $item;
                $class = pathinfo($item, PATHINFO_FILENAME);
                $class = explode('_', $class);
                array_shift($class);
                $class = implode($class, '_');
                $this->sql .= (new $class($command, str_replace('migration_create_','',$class)))->sql;
            }
        }
        $db = new \app\core\Model();
        $db->createDb($this->sql);

    }

    private function createModelAndMigrate($model)
    {
        $newFileModel = __DIR__ . '/app/Models/' . $model . '.php';
        $tableName = strtolower(trim(join(preg_split('/(?=[A-Z])/', $model), '_'), '_')) . 's';
        $migrateClassName = "migration_create_{$tableName}";
        $newFileMigrate = __DIR__ . "/app/database/migrations/" . time() . "_{$migrateClassName}.php";
        $runVar = '$run';
        $defaultSql = '`id`         INT(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      `name`       VARCHAR(255) NULL,
                      `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                      `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
        if (@touch($newFileModel)) {
            $fileModel = fopen($newFileModel, 'r+');
            fwrite($fileModel, "<?php\n\nnamespace app\Models;\n\nuse app\core\Model;\nuse app\core\StaticModelTrait;\n\nclass {$model} extends Model \n{ \n    use StaticModelTrait;\n}");
            fclose($fileModel);
            @touch($newFileMigrate);
            $fileMigrate = fopen($newFileMigrate, 'r+');
            fwrite($fileMigrate, "<?php\n\nuse app\database\Migration;\n\nclass {$migrateClassName} extends Migration \n{ \n    protected $runVar = '{$defaultSql}';\n}");
            fclose($fileMigrate);
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