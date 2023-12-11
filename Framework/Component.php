<?

namespace Framework;

class Component
{
    use RenderPartialTrait;

    protected $template;


    private function __construct(?string $template = null)
    {

        if (!empty($template)) {
            $this->template = $template;
        }

        if (empty($this->template)) {
            throw new \InvalidArgumentException("Component template is not set");
        }
    }

    public static function include(array $data, ?string $template = null)
    {
        $component = new static($template);
        $classNameParts = explode("\\",static::class);
        $componentName = str_replace("component","",strtolower(array_pop($classNameParts)));
    
        $templatePath = Application::getInstance()->getViewsPath().DS."components".DS.$componentName.DS.$component->template.".php";
        
        return $component->renderPartial($templatePath, $data);
    }
}
