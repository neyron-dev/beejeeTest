<?

namespace Framework;

class Controller
{
    use RenderPartialTrait;
    
    private $layout = "layouts/main.php";
    final public function render(string $template, array $parameters)
    {


        $classPartials = explode("\\", static::class);
        $viewFolder = str_replace("controller", "", strtolower(end($classPartials)));
        $viewFullPath = Application::getInstance()->getViewsPath() . DIRECTORY_SEPARATOR . $viewFolder . DIRECTORY_SEPARATOR . $template . ".php";

        $viewContent = $this->renderPartial(
            $viewFullPath,
            $parameters
        );

        $layoutFullPath = Application::getInstance()->getViewsPath() . DIRECTORY_SEPARATOR . $this->layout;

        $layoutContent = $this->renderPartial(
            $layoutFullPath,
            [
                "content" => $viewContent
            ]
        );



        return $layoutContent;
    }

}
