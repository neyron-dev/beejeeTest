<?

namespace Framework;

use Framework\Query;
use Framework\Request;

class ActiveProvider
{

    private ActiveProviderResult $_result;

    public function __construct(Query $query, int $pageSize = 3)
    {
        $this->_result = new ActiveProviderResult();

        /**
         * @var Model $moodelName
         */
        $modelName = $query->getModelName();
        $count = $query->count();


        if ($count == 0) {
            return;
        }
        $currentPage = Request::getInstance()->getPageNumber();
        $offset = 0;
        if ($currentPage > 1) {
            $offset = ($currentPage - 1) * $pageSize;
        }

        $query->limit($pageSize)->offset($offset);

        $byParam = Request::getInstance()->getParam("by");

        if(empty($byParam))
        {
            $byParam = "id";
        }
        if (in_array($byParam, $modelName::sortableFields())) {
            $orderParam = Request::getInstance()->getParam("order");
            if (empty($orderParam) || strtolower($orderParam) != "asc") {
                $orderParam = "DESC";
            }
            $query->orderBy([$byParam => $orderParam]);
        }
        $modelsArray = $query->fetchAll();

        $this->_result->setModels($modelsArray);

        $pagesCount = ceil($count / $pageSize);
        $this->_result->setPages($pagesCount);
        $this->_result->setCurrentPage($currentPage);
    }

    public function getResult(): ActiveProviderResult
    {
        return $this->_result;
    }
}
