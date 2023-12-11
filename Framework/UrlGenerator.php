<?

namespace Framework;

final class UrlGenerator
{
    /**
     * @var \ArrayAccess<Route>
     */
    private $routes;

    public function __construct(\ArrayAccess $routes)
    {
        $this->routes = $routes;
    }

    public function generate(string $name, array $vars = [], array $parameters = []): string
    {
        if ($this->routes->offsetExists($name) === false) {
            throw new \InvalidArgumentException(
                sprintf('Unknown %s name route', $name)
            );
        }
        $route = $this->routes[$name];
        if ($route->hasVars() && $vars === []) {
            throw new \InvalidArgumentException(
                sprintf('%s route need parameters: %s', $name, implode(',', $route->getVarsNames()))
            );
        }
        return self::resolveUri($route, $vars, $parameters);
    }

    private static function resolveUri(Route $route, array $vars, array $parameters): string
    {
       
        $directoryUrl =  str_replace("/public/index.php", "", $_SERVER['PHP_SELF']);
        $uri = $directoryUrl.$route->getPath();
        foreach ($route->getVarsNames() as $variable) {
            $varName = trim($variable, '{\}');
            if (array_key_exists($varName, $vars) === false) {
                throw new \InvalidArgumentException(
                    sprintf('%s not found in parameters to generate url', $varName)
                );
            }
            $uri = str_replace($variable, $vars[$varName], $uri);
        }
        $parameters = array_merge(Request::getInstance()->getParameters(),$parameters);
        if (!empty($parameters)) {
        
            $parametersStringArray = [];
            foreach ($parameters as $key => $parameter) {
                $paramString = $key."=".$parameter;
                $parametersStringArray[] = $paramString;
            }
            $parametersResult = implode("&",$parametersStringArray);
            $uri .= "?".$parametersResult;
        }

      
        return $uri;
    }
}
