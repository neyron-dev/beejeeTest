<?

namespace App\Components;

use Framework\ActiveProviderResult;
use Framework\Component;
use Framework\Router;
use Framework\UrlGenerator;

class SortComponent extends Component
{
    protected $template = "sort";

    public static function include($data, ?string $template = null)
    {
        return parent::include($data, $template);
    }
}
