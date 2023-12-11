<?

namespace Framework;

final class Request
{
    protected static $_instance;

    private array $_parameters;
    private function __construct()
    {
        $this->removeFoldersFromUrl();
        $this->setParameters();
    }

    private function removeFoldersFromUrl()
    {
        $rootPath = str_replace("/public/index.php", "", $_SERVER['PHP_SELF']);
        $_SERVER['REQUEST_URI'] = str_replace($rootPath, "", $_SERVER['REQUEST_URI']);
    }

    public static function getInstance(): Request
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function setParameters()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        $result = [];
        if ($position !== false) {
            $parameters = explode("&", substr($path, $position + 1));


            foreach ($parameters as $parameter) {
                list($key, $value) = explode("=", $parameter);
                $result[$key] = $value;
            }
        }

        $this->_parameters = $result;
    }

    public static function getPageNumber()
    {
        return static::getInstance()->getParam("page") ? (int) static::getInstance()->getParam("page") : 1;
    }
    public function getParam(string $key)
    {
        if (isset($this->_parameters[$key])) {
            return $this->_parameters[$key];
        }

        return null;
    }

    public function getParameters()
    {
        return $this->_parameters;
    }

    public function getUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false)
            return $path;
        return substr($path, 0, $position);
    }

    public function getMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    private function __clone()
    {
    }
}
