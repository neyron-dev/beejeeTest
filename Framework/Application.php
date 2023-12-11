<?

namespace Framework;

final class Application
{
    private string $_applicationDir;
    private DbConfig $_dbConfig;
    protected static $_instance;

    protected \PDO $_dbConnection;

    public static function getInstance(): Application
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function __construct()
    {
        $trace = debug_backtrace();
        $this->_applicationDir = dirname(dirname($trace[1]["file"]));

        $this->loadConfigs();
        $this->_dbConnection = new \PDO(
            "mysql:host={$this->_dbConfig->getDbHost()};dbname={$this->_dbConfig->getDbName()}", 
            $this->_dbConfig->getDbUser(), $this->_dbConfig->getDbPassword()
        );
    }


    public function getPath()
    {
        return $this->_applicationDir;
    }

    public function getViewsPath()
    {
        return $this->_applicationDir . DIRECTORY_SEPARATOR . "views";
    }
    private function loadConfigs()
    {
        $this->_dbConfig = new DbConfig($this->_applicationDir);
    }
    private function loadRoutes()
    {
        $routesDir = $this->_applicationDir . DIRECTORY_SEPARATOR . "routes";
        $objectsInRoutesDir = scandir($routesDir);
        foreach ($objectsInRoutesDir as $object) {
            $objectAbsolutePath = $routesDir . DIRECTORY_SEPARATOR . $object;

            if (is_file($objectAbsolutePath))
                require_once $objectAbsolutePath;
        }
    }

    public function getDbConnection() {
        return $this->_dbConnection;
    }
    public function run()
    {
        try {
            $this->loadRoutes();
            $requestInstance = Request::getInstance();
            return Router::getInstance()->resolve($requestInstance);
        }
        catch(NotFoundException)
        {
            echo "Тут будет страница 404";//TODO
        }
        
    }

    private function __clone()
    {
    }
}
