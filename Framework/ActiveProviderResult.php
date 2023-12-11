<?
namespace Framework;

class ActiveProviderResult
{
    private $_pages = 0;
    private $_currentPage = 0;
    private array $_models = [];

    public function setPages(int $pages) 
    {
        $this->_pages = $pages;
    }
    public function setCurrentPage(int $currentPage) 
    {
        $this->_currentPage = $currentPage;
    }

    /**
     * @param array[Model] $models
     */
    public function setModels(array $models) 
    {
        foreach($models as $model)
        {
            if(($model instanceof Model) == false){
                throw new \InvalidArgumentException("ActiveProviderResult must contain Model's array");
            }
        }
        $this->_models = $models;
    }

    public function getPages()
    {
        return $this->_pages;
    }
    public function getCurrentPage()
    {
        return $this->_currentPage;
    }
    public function getModels()
    {
        return $this->_models;
    }
}