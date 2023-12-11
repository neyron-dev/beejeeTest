<?

namespace Framework;

class Query
{
    private string $_command;
    private string $_modelName;
    private string $_tableName;

    private string $_select;
    private string $_limit;
    private string $_offset;
    private string $_orderBy;

    private function __construct()
    {
    }
    public function getModelName(): string
    {
        return $this->_modelName;
    }
    public static function select(string $modelName, array $fields, string $tableName)
    {

        $query = new self;
        $query->_modelName = $modelName;
        $query->_tableName = $tableName;
        $select = "SELECT ";
        $select .= implode(",", $fields);
        $select .= " FROM `{$tableName}`";
        $query->_select = $select;
        return $query;
    }
    public function count(): int
    {
        //echo $this->_command;
        $sqlQuery = $this->buildQuery("SELECT COUNT(*) FROM " . $this->_tableName);
        $res = Application::getInstance()->getDbConnection()->query($sqlQuery);
        $count = $res->fetchColumn();
        return $count;
    }
    public function limit(int $limit)
    {
        $this->_limit = " LIMIT {$limit}";
        return $this;
    }
    public function offset(int $offset)
    {
        $this->_offset = " OFFSET {$offset}";
        return $this;
    }

    public function orderBy(array $orderArray = ["id"=>"DESC"])
    {
        $orderKey = key($orderArray);
        $this->_orderBy = " ORDER BY `".key($orderArray)."` ".$orderArray[$orderKey];
       
        return $this;
    }

    public function fetchAll(): array
    {
        $modelsArray = [];

        $sqlQuery = $this->buildQuery($this->_select);

        $statement = Application::getInstance()->getDbConnection()->query($sqlQuery);
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $queryResult) {
            $model = new $this->_modelName;

            foreach ($queryResult as $key => $value) {
                $model->$key = $value;
            }
            $modelsArray[] = $model;
        }

        return $modelsArray;
    }

    private function buildQuery(string $select): string
    {
        $sqlQuery = $select;
        if (!empty($this->_orderBy)) {
            $sqlQuery .= $this->_orderBy;
        }
        if (!empty($this->_limit)) {
            $sqlQuery .= $this->_limit;
        }
        if (!empty($this->_offset)) {
            $sqlQuery .= $this->_offset;
        }
        
        return $sqlQuery;
    }
}
