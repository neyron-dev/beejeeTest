<?
namespace Framework;

trait RenderPartialTrait {
    protected function renderPartial($templatePath, $data)
    {
        if (!file_exists($templatePath)) {
            throw new \Exception("View from path {$templatePath} not found");
        }
        extract($data);
        ob_start();
        require($templatePath);
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}