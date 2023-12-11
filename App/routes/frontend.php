<?

use App\Controllers\SiteController;
use Framework\Router;

$router = Router::getInstance();

$router->add("index_page", "/", [SiteController::class, "index"]);
$router->add("todo-item", "/view/{id}", [SiteController::class, "view"]);