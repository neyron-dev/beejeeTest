<?

namespace Framework;

use ArrayIterator;

final class Router
{
    protected ArrayIterator $_routes;

    protected static $_instance;
    private function __construct()
    {
        $this->_routes = new ArrayIterator();
    }

    public function getRoutes():ArrayIterator 
    {
        return $this->_routes;
    }
    public static function getInstance(): Router
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function add(string $name, string $path, array $parameters, array $methods = ["GET"]): void
    {
        $this->_routes->offsetSet($name, new Route($name, $path, $parameters, $methods));
    }


    public function resolve(Request $request)
    {
        $route = self::matchFromPath($request->getPath(), $request->getMethod());

        $parameters = $route->getParameters();

        $arguments = $route->getVars();

        $controllerName = $parameters[0];
        $methodName = $parameters[1] ?? null;

        $controller = new $controllerName();
        if (!is_callable($controller)) {
            $controller =  [$controller, "action" . ucfirst($methodName)];
        }

        return $controller(...array_values($arguments));
    }

    public function matchFromPath(string $path, string $method): Route
    {
        foreach ($this->_routes as $route) {
            if ($route->match($path, $method) === false) {
                continue;
            }

            return $route;
        }

        throw new NotFoundException(
            'No route found for ' . $method
        ); 
    }
}
