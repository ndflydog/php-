<?php
abstract class ActiveRecord
{
    protected static $table;
    protected $fieldvalues;
    public $select;
    
    public static function findById($id)
    {
        $query = "select * from `".static::$table."` where id = ".$id;
        return static::createDomain($query);
    }

    public function get ($fieldname)
    {
        return $this->fieldvalues[$fieldname];
    }

    public static function callStatic($method, $args)
    {
        $field = preg_replace('/^findBy(\w*)$/', ' ${1} ', $method);
        $query = "select * from `".static::$table."` where ".$field."='".$args[0]."'";
        return static::createDomain($query);
    }

    private static function createDomain($query)
    {
        $domain = new static();
        $domain->fieldvalues = [];
        $domain->select = $query;
        foreach (static::$fields as $field => $type) {
            $domain->fieldvalues[$field] = '';
        }
        return $domain;
    }
}