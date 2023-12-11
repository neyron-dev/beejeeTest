<?
namespace Framework;

abstract class Model
{

    public static string $tableName;
    public static function find():Query
    {
        $query = Query::select(static::class, ["*"], static::$tableName);
        return $query;
    }
    abstract public static function sortableFields(): array;

    abstract public static function fieldLabels(): array;

}