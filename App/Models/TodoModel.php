<?

namespace App\Models;

use Framework\Model;

class TodoModel extends Model
{
    public static string $tableName = "todo";

    public static function sortableFields(): array
    {
        return [
            "id",
            "name",
            "email",
            "task"
        ];
    }

    public static function fieldLabels(): array
    {
        return [
            "id" => "Id",
            "name" => "Name",
            "email" => "Email",
            "task" => "Task"
        ];
    }
}
