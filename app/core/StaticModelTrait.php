<?php


namespace app\core;


trait StaticModelTrait
{
    protected $table;

    public function __construct()
    {
        $table = explode('\\', __CLASS__);
        $tableName = strtolower(trim(join(preg_split('/(?=[A-Z])/', end($table)), '_'), '_')) . 's';
        $this->table = $tableName;
    }

    /**
     * @return mixed
     */
    public static function findAll()
    {
        return (new self)->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function findOne($id)
    {
        return (new self)->find($id);
    }

    public static function create($data)
    {
        return (new self)->created($data);
    }
}